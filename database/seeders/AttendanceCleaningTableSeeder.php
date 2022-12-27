<?php

namespace Database\Seeders;

use App\Models\Attendance;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttendanceCleaningTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $duplicates = DB::table('attendances')
            ->select('registration_uuid', 'slot_id', DB::raw('COUNT(*) as `count`'))
            ->groupBy('registration_uuid', 'slot_id')
            ->havingRaw('COUNT(*) > 1')
            ->get();

        $this->command->info('---------------- count: '.$duplicates->count().' ---------------');

        foreach ($duplicates as $data) {
            $this->command->info('---------------- '.$data->registration_uuid.' : '. $data->count .'---------------');
            $obj = Attendance::where('registration_uuid', $data->registration_uuid)
                ->where('slot_id', $data->slot_id)
                ->first();

                Attendance::where('registration_uuid', $data->registration_uuid)
                ->where('slot_id', $data->slot_id)
                ->delete();

                Attendance::create([
                    'id' => $obj->id,
                    'registration_uuid' => $obj->registration_uuid,
                    'local_church' => $obj->local_church,
                    'slot_id' => $obj->slot_id,
                    'created_at' => $obj->created_at,
                    'updated_at' => $obj->updated_at
                ]);
        }
    }
}

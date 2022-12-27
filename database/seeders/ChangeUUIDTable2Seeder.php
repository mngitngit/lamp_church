<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\RebookingActivities;
use App\Models\Registration;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChangeUUIDTable2Seeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $toChange = array(
            // ['old'=>'LPCA00532', 'new'=>'LPCA00315'], --> used by Heramar Gigi Absalon
            ['old'=>'LPCA00702', 'new'=>'LPCA00320'],
            ['old'=>'LPCA00714', 'new'=>'LPCA00412'],
            ['old'=>'LPCA00772', 'new'=>'LPCA00418'],
            // ['old'=>'LPCA00775', 'new'=>'LPCA00334'], --> Ma. Victoria Geral
            ['old'=>'LPCA00810', 'new'=>'LPCA00422'],
            ['old'=>'LPCA00811', 'new'=>'LPCA00423'],
            ['old'=>'LPCA00864', 'new'=>'LPCA00425']
        );

        foreach ($toChange as $data) {
            $this->command->info('---------------- change awta card number ---------------');
            $this->command->info('---------------| ' . $data['old'] . ' --> ' . $data['new'] . ' |--------------');
            $this->command->info('** getting old values **');
            $oldpayments = Payment::where('registration_uuid', $data['old'])->get();
            $oldbookings = Booking::where('registration_uuid', $data['old'])->get();
            $oldrebooking = RebookingActivities::where('registration_uuid', $data['old'])->get();
            $this->command->info('** deleting old values **');
            Payment::where('registration_uuid', $data['old'])->delete();
            Booking::where('registration_uuid', $data['old'])->delete();
            RebookingActivities::where('registration_uuid', $data['old'])->delete();

            $this->command->info('** updating uuid **');
            Registration::where('uuid', $data['old'])->update([
                'uuid' => 'EDITED'
            ]);

            Registration::where('uuid', 'EDITED')->update([
                'uuid' => $data['new']
            ]);

            $this->command->info('** updating uuid of other references **');

            $this->command->info('** inserting references: old payments **');
            foreach ($oldpayments as $payment) {
                $payment = $payment->getRawOriginal();

                Payment::create([
                    'id' => $payment['id'],
                    'registration_uuid' => $data['new'],
                    'amount' => $payment['amount'],
                    'date_paid' => $payment['date_paid'],
                    'user_id' => $payment['user_id'],
                    'created_at' => $payment['created_at'],
                    'updated_at' => $payment['updated_at']
                ]);
            }

            $this->command->info('** inserting references: old bookings **');
            foreach ($oldbookings as $booking) {
                $booking = $booking->getRawOriginal();

                Booking::create([
                    'id' => $booking['id'],
                    'registration_uuid' => $data['new'],
                    'slot_id' => $booking['slot_id'],
                    'local_church' => $booking['local_church'],
                    'created_at' => $booking['created_at'],
                    'updated_at' => $booking['updated_at'],
                ]);
            }

            $this->command->info('** inserting references: old rebookings **');
            foreach ($oldrebooking as $rebooking) {
                $rebooking = $rebooking->getRawOriginal();

                RebookingActivities::create([
                    'id' => $rebooking['id'],
                    'registration_uuid' => $data['new'],
                    'description' => $rebooking['description'],
                    'created_at' => $rebooking['created_at'],
                    'updated_at' => $rebooking['updated_at'],
                ]);
            }
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

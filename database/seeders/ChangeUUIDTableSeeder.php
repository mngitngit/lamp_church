<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\RebookingActivities;
use App\Models\Registration;
use Illuminate\Database\Seeder;

class ChangeUUIDTableSeeder extends Seeder
{
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $toChange = array(
            ['old'=>'LPCA00454', 'new'=>'LPCA00310'],
            ['old'=>'LPCA00460', 'new'=>'LPCA00312'],
            ['old'=>'LPCA00506', 'new'=>'LPCA00313'],
            ['old'=>'LPCA00515', 'new'=>'LPCA00314'],
            // ['old'=>'LPCA00532', 'new'=>'LPCA00315'], --> duplicate
            ['old'=>'LPCA00562', 'new'=>'LPCA00315'], // prio
            ['old'=>'LPCA00597', 'new'=>'LPCA00316'],
            // ['old'=>'LPCA00702', 'new'=>'LPCA00320'], --> duplicate
            // ['old'=>'LPCA00714', 'new'=>'LPCA00318'], --> used by Raquel Cuaderno
            // ['old'=>'LPCA00772', 'new'=>'LPCA00320'], --> duplicate
            // ['old'=>'LPCA00775', 'new'=>'LPCA00334'], --> duplicate
            ['old'=>'LPCA00781', 'new'=>'LPCA00324'],
            // ['old'=>'LPCA00810', 'new'=>'LPCA00325'], --> used by Johnny Orsos
            // ['old'=>'LPCA00811', 'new'=>'LPCA00334'], --> duplicate
            ['old'=>'LPCA00820', 'new'=>'LPCA00460'],
            // ['old'=>'LPCA00864', 'new'=>'LPCA00335'], --> used by ELIZABETH GATDULA
            ['old'=>'LPVA00007', 'new'=>'LPMU00388'],
            ['old'=>'LPTA00152', 'new'=>'LPTA00127'],
            ['old'=>'LPTA00159', 'new'=>'LPTA00128'],
            ['old'=>'LPTA00173', 'new'=>'LPTA00129'],
            ['old'=>'LPTA00176', 'new'=>'LPTA00131'],
            ['old'=>'LPTA00181', 'new'=>'LPTA00132'],
            ['old'=>'LPTA00205', 'new'=>'LPTA00133'],
            ['old'=>'LPTA00209', 'new'=>'LPTA00134'],
            ['old'=>'LPTA00177', 'new'=>'LPTA00104'],
            ['old'=>'LPTA00174', 'new'=>'LPTA00084'],
            ['old'=>'LPTA00175', 'new'=>'LPTA00085'],
            ['old'=>'LPDA00202', 'new'=>'LPDA00141'],
            ['old'=>'LPMU00664', 'new'=>'LPMU00361'],
            ['old'=>'LPMU00671', 'new'=>'LPMU00407']
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

        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

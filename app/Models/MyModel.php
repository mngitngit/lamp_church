<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyModel extends Model
{
    use HasFactory;

    protected $trackable = [
        'uuid',
        'email',
        'firstname',
        'lastname',
        'facebook_name',
        'registration_type',
        'local_church',
        'country',
        'category',
        'rate',
        'attending_option',
        'can_book_rate',
        'can_book_days',
        'cluster_group',
        'visitor_to_member'
    ];

    function getTrackable()
    {
        return $this->trackable;
    }

    function updateStaffNotes($uuid, $details, array $messages)
    {
        $notes = $details;

        foreach ($messages as $message) {
            array_unshift($notes, [
                'user' => auth()->user()->name ?? '',
                'message' => $message,
                'timestamp' => date('M d, Y h:i A')
            ]);
        }

        $registration = Registration::where('uuid', $uuid)->update([
            'notes' => $notes
        ]);

        return $registration;
    }

    function updateActivities($uuid, $details, array $messages)
    {
        $activities = $details;

        foreach ($messages as $message) {
            array_unshift($activities, [
                'user' => auth()->user()->name ?? '',
                'message' => $message,
                'timestamp' => date('M d, Y h:i A')
            ]);
        }

        $registration = Registration::where('uuid', $uuid)->update([
            'activities' => $activities
        ]);

        return $registration;
    }

    function updateBookingActivities($uuid, $details, array $messages)
    {
        $booking_activities = $details;

        foreach ($messages as $message) {
            array_unshift($booking_activities, [
                'user' => auth()->user()->name ?? '',
                'message' => $message,
                'timestamp' => date('M d, Y h:i A')
            ]);
        }

        $registration = Registration::where('uuid', $uuid)->update([
            'booking_activities' => $booking_activities
        ]);

        return $registration;
    }
}

<?php

namespace App\Notifications;

use App\Enums\BookingStatus;
use App\Models\Registration;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Registered extends Notification
{
    use Queueable;

    protected $registration;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Registration $registration)
    {
        $this->registration = $registration;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = url('/booking/' . $this->registration->uuid);

        if ($this->registration->booking_status === BookingStatus::Pending) {
            $markup = 'mail.registration.pending';
            $subject = 'Booking on-hold for Annual Worship and Thanksgiving 2023';
        } else if ($this->registration->booking_status === BookingStatus::Cancelled) {
            $markup = 'mail.registration.cancelled';
            $subject = 'Booking cancelled for Annual Worship and Thanksgiving 2023';
            $url = url('/booking');
        } else if ($this->registration->booking_status === BookingStatus::Confirmed) {
            $markup = 'mail.registration.confirmed';
            $subject = 'Booking confirmed for Annual Worship and Thanksgiving 2023';
        }

        $balance = $this->registration->rate - $this->registration->payments_sum_amount;

        $booked_dates = array_map(function ($dates) {
            return $dates['slot']['event_date'];
        }, $this->registration->bookings->toArray());

        return (new MailMessage)
            ->subject($subject)
            ->markdown($markup, [
                'url' => $url,
                'name' => $this->registration->fullname,
                'balance' => number_format($balance),
                'minimum' => number_format($this->registration->can_book_rate),
                'due_date' => date('M d, Y', strtotime($this->registration->created_at . ' + 7 days')),
                'booked_dates' => implode(', ', $booked_dates),
                'registration' => $this->registration
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

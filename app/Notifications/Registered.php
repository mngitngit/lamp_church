<?php

namespace App\Notifications;

use App\Enums\AttendingOption;
use App\Enums\BookingStatus;
use App\Enums\PaymentStatus;
use App\Enums\RegistrationType;
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
        $url = url('/ticket/' . $this->registration->uuid);

        if ($this->registration->booking_status === BookingStatus::Pending) {
            $markup = 'mail.registration.pending';
            $subject = 'Booking on-hold for Annual Worship and Thanksgiving ' . env('YEAR');
        } else if ($this->registration->booking_status === BookingStatus::Cancelled) {
            $markup = 'mail.registration.cancelled';
            $subject = 'Booking cancelled for Annual Worship and Thanksgiving ' . env('YEAR');
            $url = url('/booking/');
        } else if ($this->registration->booking_status === BookingStatus::Confirmed) {
            $markup = 'mail.registration.confirmed';
            $subject = 'Booking confirmed for Annual Worship and Thanksgiving ' . env('YEAR');
        }

        // $this->registration->booking_status === BookingStatus::Confirmed && 
        if ($this->registration->attending_option === AttendingOption::Online) {
            // guest confirmation
            // member unpaid = pending
            // member paid = confirmation
            if ($this->registration->payment_status === PaymentStatus::Paid || $this->registration->registration_type === RegistrationType::Guest) {
                $markup = 'mail.registration.online.confirmed';
                $subject = 'Registration completed for Annual Worship and Thanksgiving ' . env('YEAR');
                $url = 'https://www.facebook.com/groups/446318280091482';
            }

            if ($this->registration->registration_type === RegistrationType::Member && ($this->registration->payment_status === PaymentStatus::Unsettled || $this->registration->payment_status === PaymentStatus::Partial)) {
                $markup = 'mail.registration.online.pending';
                $subject = 'Registration pending payment for Annual Worship and Thanksgiving ' . env('YEAR');
            }
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
                'balance' => strval(number_format($balance)) . ($this->registration->avail_new_lamp_id === 'yes' ? ' (with additional Php 35 for LAMP ID)' : ''),
                'minimum_due' => number_format($this->registration->can_book_rate),
                'minimum_payment_due_date' => date('M d, Y', strtotime($this->registration->booked_date . ' + 7 days')),
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

<?php

namespace App\Notifications;

use App\Models\Registration;
use App\Enums\AttendingOption;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Reminder extends Notification
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
        if ($this->registration->attending_option === AttendingOption::Hybrid) {
            $url = url('/ticket/' . $this->registration->uuid);
            $markdown = 'mail.registration.reminder';
            $file = storage_path(). "/images/event_details.pdf";
        } else {
            $url = env('FB_GROUP_URL');
            $markdown = 'mail.registration.online.reminder';
            $file = storage_path(). "/images/programme.pdf";
        }

        if (env('TEST_MAIL') == true) {
            $url = env('FB_GROUP_URL');
            $markdown = 'mail.registration.online.reminder';
            $file = storage_path(). "/images/programme.pdf";
        }

        return (new MailMessage)
            ->subject('Reminder: Upcoming Annual Worship and Thanksgiving Assembly TOMORROW!')
            ->markdown($markdown, [
                'url' => $url,
                'name' => $this->registration->fullname
            ])
            ->attach($file, [
                'as' => $file,
                'mime' => 'application/pdf',
            ]);;

    }
}

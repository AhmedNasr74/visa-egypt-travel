<?php

namespace App\Notifications\Admin;

use App\Models\Appointment;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentRequestNotification extends Notification
{
    private Appointment $appointment;

    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Appointment Request')
            ->greeting('Hello Admin,')
            ->line("You've a new appointment request.")
            ->line('Client: ' .  $this->appointment->full_name)
            ->line('Phone: ' . $this->appointment->phone_with_code)
            ->line('Email: ' . $this->appointment->email)
            ->line('Nationality: ' . $this->appointment->nationality)
            ->line('Adults: ' . $this->appointment->adults)
            ->line('Children: ' . $this->appointment->children)
            ->line('Arrival Date: ' . $this->appointment->arrival_date->toDateString())
            ->line('Departure Date: ' . $this->appointment->departure_date->toDateString())
            ->line('Number Of Days: ' . $this->appointment->days)
            ->line('Hear About Us From: ' . $this->appointment->hear_about_us)
            ->line('Notes: ' . $this->appointment->notes)
            ->line('Thank you for using our application!');
    }

    public function toArray($notifiable): array
    {
        return [];
    }
}

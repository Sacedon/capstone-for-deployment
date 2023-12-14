<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Models\LeaveRequest;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LeaveRequestEndedNotification extends Notification
{
    use Queueable;

    protected $leaveRequest;

    /**
     * Create a new notification instance.
     */
    public function __construct($leaveRequest)
    {
        $this->leaveRequest = $leaveRequest;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        // Customize the email notification
        return (new MailMessage)
            ->line('Your leave request has been ended.')
            ->action('View Leave Request', url('/leave-requests/'.$this->leaveRequest->id))
            ->line('Status: ' . $this->leaveRequest->status);

    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Your leave request has been Ended.', // Customize the message as needed
            'link' => '/leave-requests/' . $this->leaveRequest->id,
        ];
    }
}

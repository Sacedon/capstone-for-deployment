<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Models\LeaveRequest;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LeaveRequestRejected extends Notification
{
    use Queueable;

    protected $leaveRequest;

    /**
     * Create a new notification instance.
     */
    public function __construct(LeaveRequest $leaveRequest)
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
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
        ->line('Your leave request has been rejected.') // Updated message
        ->action('View Leave Request', route('leave-requests.show', $this->leaveRequest->id))
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
            'message' => 'Your leave request has been rejected.', // Customize the message as needed
            'link' => '/leave-requests/' . $this->leaveRequest->id,
        ];
    }
}

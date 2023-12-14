<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Models\LeaveRequest;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LeaveRequestAccepted extends Notification
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
    public function via($notifiable)
    {
        return ['mail', 'database']; // You can send notifications through multiple channels
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Your leave request has been accepted by the Supervisor and Admin.') // Updated message
            ->action('View Leave Request', route('leave-requests.show', $this->leaveRequest->id))
            ->line('Status: ' . $this->leaveRequest->status);

    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable)
    {
        return [
            'message' => 'Your leave request has been accepted by the Supervisor and Admin.', // Customize the message as needed
            'link' => '/leave-requests/' . $this->leaveRequest->id,
        ];
    }
}

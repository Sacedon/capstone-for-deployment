<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\LeaveRequest;
use App\Models\User;

class SupervisorApprovedLeaveRequest extends Notification
{
    use Queueable;

    protected $leaveRequest;
    protected $user;

    /**
     * Create a new notification instance.
     */
    public function __construct(LeaveRequest $leaveRequest, User $user)
    {
        $this->leaveRequest = $leaveRequest;
        $this->user = $user;
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
        ->line('A Department Head Request for an approval for employee leave request.')
        ->action('View Leave Request', route('leave-requests.show', $this->leaveRequest->id))
        ->line('Thank you for using our application!');
}

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'A Department Head Request for an approval for employee leave request.',
            'link' => '/leave-requests/' . $this->leaveRequest->id,
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'A Department Head Request for an approval for employee leave request.',
            'link' => '/leave-requests/' . $this->leaveRequest->id,
        ];
    }
}

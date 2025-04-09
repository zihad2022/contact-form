<?php

declare(strict_types=1);

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

final class AccountSuspendedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public User $user) {}

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        if ($this->user->is_banned) {
            return $this->bannedMessage();
        }

        return (new MailMessage)
            ->subject(__('notification.account.suspended'))
            ->line(__('Your account has been suspended.'))
            ->line(__('Reason: **:reason**', ['reason' => $this->user->suspension_reason]))
            ->line(__('Suspension will end on: :date', ['date' => $this->user->suspension_ends_at]))
            ->line(__('If you believe this is a mistake, please contact us.'));
    }

    private function bannedMessage(): MailMessage
    {
        return (new MailMessage)
            ->subject(__('notification.account.banned'))
            ->line(__('Your account has been banned.'))
            ->line(__('Reason: **:reason**', ['reason' => $this->user->suspension_reason]))
            ->line(__('If you believe this is a mistake, You can contact us describing the reason.'))
            ->line(__('Thank you for your understanding.'));
    }
}

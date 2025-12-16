<?php

namespace App\Notifications;

use App\Models\PublisherUpgradeRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class AdminPublisherUpgradeRequested extends Notification
{
    use Queueable;

    public function __construct(public PublisherUpgradeRequest $req) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $approveUrl = URL::temporarySignedRoute(
            'admin.upgrade_requests.approve',
            now()->addHours(24),
            ['upgradeRequest' => $this->req->id]
        );

        $rejectUrl = URL::temporarySignedRoute(
            'admin.upgrade_requests.reject',
            now()->addHours(24),
            ['upgradeRequest' => $this->req->id]
        );

        $u = $this->req->user;

        return (new MailMessage)
            ->subject('Permintaan Upgrade Publisher')
            ->greeting('Halo Admin,')
            ->line("User berikut meminta upgrade menjadi Publisher:")
            ->line("Nama: {$u->name}")
            ->line("Email: {$u->email}")
            ->line("Request ID: {$this->req->id}")
            ->action('Approve Upgrade', $approveUrl)
            ->line('Jika ingin menolak, klik link ini:')
            ->line($rejectUrl)
            ->line('Link berlaku 24 jam.');
    }
}

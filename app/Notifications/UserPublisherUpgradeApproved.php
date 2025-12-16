<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserPublisherUpgradeApproved extends Notification
{
    use Queueable;

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Upgrade Publisher Berhasil')
            ->greeting('Halo, ' . $notifiable->name)
            ->line('Selamat! Akun kamu sudah berhasil di-upgrade menjadi Publisher.')
            ->line('Sekarang kamu bisa akses dashboard publisher dan upload buku.')
            ->action('Buka Dashboard', url('/dashboard'));
    }
}

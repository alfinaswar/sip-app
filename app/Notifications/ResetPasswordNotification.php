<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends ResetPassword
{
    /**
     * Build the mail representation of the notification in Indonesian.
     */
    protected function buildMailMessage($url): MailMessage
    {
        $expire = config('auth.passwords.' . config('auth.defaults.passwords') . '.expire', 60);
        $appName = 'SIP Rumah Dinas KPAD Kodam Jaya';

        return (new MailMessage)
            ->subject('Permintaan Reset Kata Sandi — ' . $appName)
            ->greeting('Yth. Bapak/Ibu,')
            ->line('Kami menerima permintaan untuk mengatur ulang kata sandi akun Anda pada Aplikasi ' . $appName . '.')
            ->action('Reset Kata Sandi', $url)
            ->line('Tautan reset kata sandi ini hanya berlaku selama ' . $expire . ' menit.')
            ->line('Jika Anda tidak merasa mengajukan permintaan ini, abaikan email ini dan kata sandi Anda tidak akan berubah.')
            ->salutation("Hormat kami,\nAdministrator " . $appName);
    }
}

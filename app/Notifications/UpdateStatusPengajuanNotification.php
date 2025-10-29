<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UpdateStatusPengajuanNotification extends Notification
{
    use Queueable;

    protected $pengajuan;
    protected $status;


    /**
     * Create a new notification instance.
     */
    public function __construct($pengajuan, $status)
    {
        $this->pengajuan = $pengajuan;
        $this->status = $status;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }


    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    // public function toArray(object $notifiable): array
    // {
    //     return [
    //         //
    //     ];
    // }

    public function toDatabase($notifiable)
    {
        $data = [
            'pengajuan_id' => $this->pengajuan,
            'message' => "Pengajuan Anda dengan ID {$this->pengajuan} {$this->status}",
        ];

        return $data;
    }
}

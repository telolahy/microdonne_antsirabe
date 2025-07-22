<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DownloadRejectNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        // 
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Votre demande de téléchargement a été rejetée 🚫')
                    ->greeting('Bonjour ' . $notifiable->name . ',')
                    ->line('Nous sommes désolés de vous informer que votre demande de téléchargement a été rejetée.')
                    ->line('• Statut : Rejeté')
                    ->line('Pour plus d’informations sur les raisons du rejet ou pour soumettre une nouvelle demande, veuillez contacter notre équipe.')
                   // ->action('Contacter le support', route('contact.support'))
                    ->line('Merci de votre compréhension.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

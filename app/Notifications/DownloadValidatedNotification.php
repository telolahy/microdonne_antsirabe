<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Download;

class DownloadValidatedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $download;

    public function __construct(Download $download)
    {
        $this->download = $download;
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
       // dd($this->download->motif);
        return (new MailMessage)
            ->subject('Votre téléchargement a été validé ✅')
            ->greeting('Bonjour ' . $notifiable->name . ',')
            ->line('Excellente nouvelle ! Votre téléchargement a été validé avec succès.')
            ->line('Vous pouvez maintenant télécharger votre fichier en toute sécurité.')
            ->line('**Détails du fichier :**')
            ->line('• Statut : Approuvé')
            ->action('Télécharger le fichier', route('files.keke', $this->download->file_id))
            ->line('Le lien de téléchargement restera actif pendant 30 jours.')
            ->line('Merci de nous faire confiance pour vos téléchargements !');
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

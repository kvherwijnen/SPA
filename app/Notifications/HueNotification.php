<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class HueNotification extends Notification
{
    use Queueable;

    private $notifiable;
    private $from;
    private $message;

    /**
     * Create a new notification instance.
     *
     * @param        $notifiable
     * @param        $from
     * @param string $message
     */
    public function __construct($notifiable, $from, $message)
    {
        if ($from)
            $this->from = $from;

        if ($message)
            $this->message = $message;
        else
            $this->message = 'Bericht kan niet geladen worden...';

        return $this->notifiable = $notifiable;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return SlackMessage
     */
    public function toSlack($notifiable)
    {
        $this->from ?
            $from = $this->from : $from = 'Hue Error';
        $this->message ?
            $message = $this->message : $message = 'Hue Error';

        return (new SlackMessage)
            ->from($from, ':bulb:')
            ->to('#hue')
            ->content($message);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

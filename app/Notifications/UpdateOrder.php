<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UpdateOrder extends Notification
{
    use Queueable;
    public $ad;
    public $user;
    public $text;
    public $title;
    public $link;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($ad,$user,$text,$title,$link)
    {
        $this->ad=$ad;
        $this->user=$user;
        $this->text=$text;
        $this->title=$title;
        $this->link=$link;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
                    ->line($this->title)
                    ->line($this->text )
                    ->action('View', url('/').$this->link)
                    ->line('Thank you for using our application!');
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
            'ad'=>$this->ad,
            'user'=>$this->user,
            'text'=>$this->text,
            'title'=>$this->title,
            'link'=>$this->link,
        ];
    }
}

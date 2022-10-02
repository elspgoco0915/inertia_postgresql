<?php

namespace App\Listeners;

use App\Events\CourseFinished;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailNotification
{

     private Mailer $mailer;
     
     /**
     * Create the event listener.
     *
     * @return void
     */
     public function __construct(Mailer $mailer)
     {
        $this->mailer = $mailer;
     }

    /**
     * Handle the event.
     *
     * @param  \App\Events\CourseFinished  $event
     * @return void
     */
    public function handle(CourseFinished $event)
    {
         $this->mailer->raw($event->user_name . 'さんの全ての講義の受講が完了したことを通知します。', function($message) {
             $message->subject('受講完了通知')->to("hoge@hogehoge.com");
         });
    }
}
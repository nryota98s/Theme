<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;
use Laravel\Telescope\Events\TelescopeErrorEvent;

class TelescopeErrorListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(TelescopeErrorEvent $event)
    {
        $error = $event->entry;

        // メール送信の処理を実装する
        Mail::send([], [], function (Message $message) use ($error) {
            $message->to('email@example.com') // 送信先のメールアドレスを指定
                ->subject('Telescope エラー通知') // メールの件名を指定
                ->setBody('テレスコープでエラーが発生しました。: ' . $error->content); // メールの本文を指定
        });
    }
}

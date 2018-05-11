<?php
/**
 * Created by PhpStorm.
 * User: RyanWu
 * Date: 2018/5/11
 * Time: 11:14
 */

namespace App\Chennel;

use Illuminate\Notifications\Notification;

class PusherChennel
{

    /**
     * 发送给定通知.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
       return app('pusher')->trigger( $notifiable->routeNotificationFor('pusher')[0],
            $notifiable->routeNotificationFor('pusher')[1],
            $notification->toPusher()
        );
    }
}
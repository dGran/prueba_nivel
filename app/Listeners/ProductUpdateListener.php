<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\ProductUpdate;
use App\Mail\UpdateProductDataMailable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;

class ProductUpdateListener
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
    public function handle($event)
    {
        $user = User::find(1);
        $user->notify(new ProductUpdate($event->product, $event->changes));

        $mail = new UpdateProductDataMailable($event->product, $event->changes);
        Mail::to('dgranh@gmail.com')->send($mail);
    }
}

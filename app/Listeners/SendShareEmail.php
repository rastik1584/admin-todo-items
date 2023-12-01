<?php

namespace App\Listeners;

use App\Events\UserShareTodoItem;
use App\Mail\SendShareTodoItemMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendShareEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserShareTodoItem $event): void
    {
        foreach($event->users as $user_id) {
            $user = User::find($user_id);
            Mail::to($user->email)->send(new SendShareTodoItemMail($user));
        }

    }
}

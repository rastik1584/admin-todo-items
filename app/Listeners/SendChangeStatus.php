<?php

namespace App\Listeners;

use App\Events\ChangeTodoItemStatus;
use App\Mail\MailSendTodoItemStatus;
use App\Models\TodoItem;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendChangeStatus
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
    public function handle(ChangeTodoItemStatus $event): void
    {
        foreach ($event->item->share as $user) {
            Mail::to($user->email)->send(new MailSendTodoItemStatus($event->item));
        }
    }
}

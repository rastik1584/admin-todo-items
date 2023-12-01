<?php

namespace App\Providers;

use App\Events\ChangeTodoItemStatus;
use App\Events\UserShareTodoItem;
use App\Http\Controllers\LoginController;
use App\Listeners\SendChangeStatus;
use App\Listeners\SendShareEmail;
use App\Mail\SendShareTodoItemMail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        UserShareTodoItem::class => [
            SendShareEmail::class,
        ],
        ChangeTodoItemStatus::class => [
            SendChangeStatus::class,
        ]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}

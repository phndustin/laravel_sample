<?php

namespace App\Notification;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use App\Notification\Contracts\NotificationContract;
use App\Notification\Contracts\Consumers\NotificationConsumer;
use App\Notification\Supports\Firebase;
use App\Notification\Events\SendBroadcast;
use App\Notification\Listeners\ListenBroadcastNotification;
use App\Notification\Events\SendCompanyNotification;
use App\Notification\Listeners\ListenCompanyNotification;
use App\Notification\Events\SendGroupNotification;
use App\Notification\Listeners\ListenGroupNotification;
use App\Notification\Events\SendUserNotification;
use App\Notification\Listeners\ListenUserNotification;

class NotificationProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(NotificationContract::class, NotificationConsumer::class);
        $this->app->alias(NotificationContract::class, 'ekko-notification');

        $this->app->singleton(Firebase::class, function ($app) {
            return new Firebase();
        });

        $this->registerEvents();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    private function registerEvents() {
        Event::listen(SendBroadcast::class, ListenBroadcastNotification::class);
        Event::listen(SendUserNotification::class, ListenUserNotification::class);
    }
}

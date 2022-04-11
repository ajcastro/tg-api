<?php

namespace App\Providers;

use App\Events\DepositApproved;
use App\Listeners\DepositApproved\AutoCreditPromotionBonus;
use App\Listeners\DepositApproved\DeductWebsiteCredit;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        DepositApproved::class => [
            AutoCreditPromotionBonus::class,
            DeductWebsiteCredit::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

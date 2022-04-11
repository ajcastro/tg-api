<?php

namespace App\Listeners\DepositApproved;

use App\Events\DepositApproved;
use App\Models\Website;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DeductWebsiteCredit
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\DepositApproved  $event
     * @return void
     */
    public function handle(DepositApproved $event)
    {
        /** @var Website */
        $website = $event->memberTransaction->website;

        $website->decrementCredit($event->memberTransaction->amount);
    }
}

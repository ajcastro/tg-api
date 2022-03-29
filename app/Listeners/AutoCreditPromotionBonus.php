<?php

namespace App\Listeners;

use App\Events\DepositApproved;
use App\Models\Member;
use App\Models\MemberPromotion;
use App\Models\MemberTransaction;
use App\Models\Promotion;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AutoCreditPromotionBonus
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\DepositApproved  $event
     * @return void
     */
    public function handle(DepositApproved $event)
    {
        /** @var Member */
        $member = $event->memberTransaction->member;
        /** @var MemberTransaction */
        $memberTransaction = $event->memberTransaction;
        /** @var MemberPromotion */
        $memberPromotion = $event->memberTransaction->memberPromotion;
        /** @var Promotion */
        $promotion = $event->memberTransaction->memberPromotion->promotion;

        if ($promotion->isGivenOnDeposit() && $promotion->isAutoRelease()) {
            $member->incrementBalanceAmount($memberPromotion->bonus_amount);
        }
    }
}

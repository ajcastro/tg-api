<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\PaginateOrListResource;
use App\Http\Controllers\Traits\StoreResource;
use App\Models\User;
use App\Notifications\BroadcastMessage;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Notification;

class BroadcastMessageController extends Controller
{
    use PaginateOrListResource;

    public function __construct()
    {
        $this->hook(function (Request $request) {
            /** @var User */
            $user = $request->user();
            $this->query = DatabaseNotification::fromSub($user->notifications()->latest()
                ->where('type', BroadcastMessage::class), 'notifications');
        });
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required',
        ]);

        /** @var User */
        $fromUser = $request->user();
        $parentGroup = $fromUser->getCurrentParentGroup();
        $notif = new BroadcastMessage($fromUser, $request->message);

        Notification::send($parentGroup->users, $notif);
    }
}

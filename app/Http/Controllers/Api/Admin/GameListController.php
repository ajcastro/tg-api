<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class GameListController extends Controller
{
    public function __invoke(Request $request)
    {
        $menus = Menu::where('parent_id', '>', 0)
            ->with('parent')
            ->get();

        return $menus;
    }
}

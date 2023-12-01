<?php

namespace App\Http\Controllers;

use App\Models\TodoItem;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('pages.dashboard.index', [
            'todoItems' => TodoItem::query()->where('user_id', \Auth::id())->count(),
            'sharedMe' => \DB::table('todo_item_share_relation')->where('user_id', \Auth::id())->count(),
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\TodoItem;

class DashboardController extends Controller
{
    /**
     * Show admin dashboard page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function __invoke()
    {
        return view('pages.dashboard.index', [
            'todoItems' => TodoItem::query()->where('user_id', \Auth::id())->count(),
            'sharedMe' => \DB::table('todo_item_share_relation')->where('user_id', \Auth::id())->count(),
        ]);
    }
}

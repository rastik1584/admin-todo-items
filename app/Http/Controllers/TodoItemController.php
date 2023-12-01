<?php

namespace App\Http\Controllers;

use App\DataTables\TodoItemDataTable;
use App\Enums\TodoItemStatusEnum;
use App\Events\UserShareTodoItem;
use App\Http\Requests\RestoreTodoItemRequest;
use App\Http\Requests\ShareTodoItemRequest;
use App\Models\TodoCategory;
use App\Models\TodoItem;
use App\Http\Requests\StoreTodoItemRequest;
use App\Http\Requests\UpdateTodoItemRequest;
use Illuminate\Http\Request;

class TodoItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, TodoItemDataTable $dataTable)
    {
        return $dataTable->with([
            'filter' => $request->all(),
        ])->render('pages.todo-items.index', [
            'deletedCount' => TodoItem::onlyTrashed()->count(),
            'categories' => TodoCategory::query()->pluck('name', 'id'),
            'statuses' => TodoItemStatusEnum::labels(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.todo-items.create', [
            'categories' => TodoCategory::query()->where('user_id', \Auth::id())->pluck('name', 'id'),
            'statuses' => TodoItemStatusEnum::labels(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTodoItemRequest $request)
    {
        try {
            $data = $request->validated();
            TodoItem::create($data);

            flash('Opperation successful', 'success');

            return redirect()->route('todo-items.index');
        } catch(\Exception $e) {
            flash('Error in save', 'error');

            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TodoItem $todoItem)
    {
        return view('pages.todo-items.edit', [
            'categories' => TodoCategory::query()->where('user_id', \Auth::id())->pluck('name', 'id'),
            'statuses' => TodoItemStatusEnum::labels(),
            'todo_item' => $todoItem,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTodoItemRequest $request, TodoItem $todoItem)
    {
        $data = $request->validated();
        $todoItem->update($data);

        flash('Operation successful', 'success');
        return redirect()->route('todo-items.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TodoItem $todoItem)
    {
        $todoItem->delete();

        flash('Operation successful', 'success');
        return redirect()->route('todo-items.index');
    }

    /**
     * Restore deleted $todoItem
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(RestoreTodoItemRequest $request)
    {
        $data = $request->validated();
        TodoItem::query()->whereId($data['todo_item_id'])->withTrashed()->update(['deleted_at' => null]);

        flash('Operation successful', 'success');
        return redirect()->route('todo-items.index');
    }

    public function share(ShareTodoItemRequest $request)
    {
        $data = $request->validated();
        $todoItem = TodoItem::query()->whereId($data['todo_item_id'])->first();
        $todoItem->share()->sync($data['user_id']);

        event(new UserShareTodoItem($data['user_id']));

        flash('Operation successful', 'success');
        return redirect()->route('todo-items.index');
    }
}

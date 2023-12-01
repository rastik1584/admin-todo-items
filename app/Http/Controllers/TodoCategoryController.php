<?php

namespace App\Http\Controllers;

use App\DataTables\TodoCategoryDataTable;
use App\Http\Requests\StoreTodoCategoryRequest;
use App\Http\Requests\UpdateTodoCategoryRequest;
use App\Models\TodoCategory;

class TodoCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TodoCategoryDataTable $dataTable)
    {
        return $dataTable->render('pages.todo-categories.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.todo-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTodoCategoryRequest $request)
    {
        try {
            $data = $request->validated();
            TodoCategory::create($data);

            flash('Successfully created', 'success');

            return redirect()->route('todo-categories.index');
        } catch(\Exception $e) {
            flash('Error create todo category', 'error');

            return redirect()->route('todo-categories.create');
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TodoCategory $todoCategory)
    {
        return view('pages.todo-categories.edit', compact('todoCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTodoCategoryRequest $request, TodoCategory $todoCategory)
    {
        $data = $request->validated();
        $todoCategory->update(['name' => $data['name']]);

        flash('Operation successful', 'success');
        return redirect()->route('todo-categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TodoCategory $todoCategory)
    {
        $todoCategory->delete();

        flash('Operation successful', 'success');
        return redirect()->route('todo-categories.index');
    }
}

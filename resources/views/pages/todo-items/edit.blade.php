@extends('layouts.app')
@section('head_title', __('Todo category create'))
@section('content')
    <h2 class="my-4 text-4xl font-semibold dark:text-gray-400">
        Todo item edit
    </h2>

    <div class="w-full flex justify-center">
        {{ html()->form('PUT', route('todo-items.update', $todo_item))->class('w-1/2')->open() }}
            @include('pages.todo-items._partials.form')
        {{ html()->form()->close() }}
    </div>
@stop

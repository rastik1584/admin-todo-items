@extends('layouts.app')
@section('head_title', __('Todo category create'))
@section('content')
    <h2 class="my-4 text-4xl font-semibold dark:text-gray-400">
        Todo category edit
    </h2>

    <div class="w-full flex justify-center">
        {{ html()->form('PUT', route('todo-categories.update', $todoCategory))->class('w-1/2')->open() }}
            @include('pages.todo-categories._partials.form')
        {{ html()->form()->close() }}
    </div>
@stop

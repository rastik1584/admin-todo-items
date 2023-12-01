@extends('layouts.app')
@section('head_title', __('Todo item create'))
@section('content')
    <h2 class="my-4 text-4xl font-semibold dark:text-gray-400">
        Todo item create
    </h2>

    <div class="w-full flex justify-center">
        {{ html()->form('POST', route('todo-items.store'))->class('w-1/2')->open() }}
            @include('pages.todo-items._partials.form')
        {{ html()->form()->close() }}
    </div>
@stop

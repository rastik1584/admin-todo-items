@extends('layouts.app')
@section('content')
    <h2 class="my-4 text-4xl font-semibold dark:text-gray-400">
        Dashboard
    </h2>

    My todo items: {{ $todoItems }} <br>
    Shared with me: {{ $sharedMe }}
@stop

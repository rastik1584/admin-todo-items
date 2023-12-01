@extends('layouts.app')
@section('head_title', __('Todo categories'))
@section('content')

    <div class="w-full flex justify-between items-center pr-5">
        <h2 class="my-4 text-4xl font-semibold dark:text-gray-400">
            Todo categories
        </h2>
        <a class="btn btn-sm btn-primary" href="{{route('todo-categories.create')}}">Add todo category</a>
    </div>
    <div class="w-full flex justify-center">
        <div class="w-[97%]">
            {!! $dataTable->table([]) !!}
        </div>
    </div>
@stop

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush

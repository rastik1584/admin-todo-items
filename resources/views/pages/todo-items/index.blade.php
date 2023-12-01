@extends('layouts.app')
@section('head_title', __('Todo items'))
@section('content')
    <div class="w-full flex justify-between items-center pr-5">
        <h2 class="my-4 text-4xl font-semibold dark:text-gray-400">
            Todo items
        </h2>

        <a href="{{ route('todo-items.create') }}" class="btn btn-sm btn-primary">Add todo item</a>
    </div>

    <div class="w-full flex justify-center">
        <div class="w-[97%]">
            @include('pages.todo-items._partials.filter')

            {!! $dataTable->table([]) !!}
        </div>
    </div>
@stop

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush

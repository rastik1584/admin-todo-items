@extends('layouts.app')
@section('head_title', 'Register')
@section('content')
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">{{ __('Register your account') }}</h2>
        </div>
        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            {{ html()->form(route('register.store'))->open() }}

                {{ html()->label('Full name')->for('name')->class("block text-sm font-medium leading-6 text-gray-900") }}
                {{ html()->text('name')->required()->class('block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 pl-2 mb-2') }}

                {{ html()->label('Email address')->for('email')->class("block text-sm font-medium leading-6 text-gray-900") }}
                {{ html()->email('email')->required()->class('block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 pl-2 mb-2') }}

                {{ html()->label('Password')->for('password')->class("block text-sm font-medium leading-6 text-gray-900") }}
                {{ html()->password('password')->required()->class("block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 pl-2 mb-2") }}

            {{ html()->button('Sign up')->class("flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 mt-3") }}

            {{ html()->form()->close() }}
        </div>
    </div>
@endsection


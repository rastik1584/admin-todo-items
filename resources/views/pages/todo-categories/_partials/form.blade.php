{{ html()->label('Category name')->for('name')->class("block text-sm font-medium leading-6 text-gray-900") }}
{{ html()->text('name', isset($todoCategory) ? $todoCategory->name : '')->class("block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 pl-2 mb-2")->required() }}

{{ html()->hidden('user_id', Auth::id()) }}

<div class="w-full flex justify-end">
    {{ html()->button('Save')->type('submit')->class("flex justify-flex-end rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 mt-3") }}
</div>


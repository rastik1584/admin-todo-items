<div class="w-full flex items-center mb-3 gap-3">
    <h2 class="my-4 text-2xl font-semibold dark:text-gray-400">Filter</h2>
    <div class="w-full flex">
        {{ html()->form('GET', route('todo-items.index'))->class('w-full inline-flex')->open() }}

        <div class="col-md-2">
            {{ html()->label('Category')->for('todo_category_id')->class("block text-sm font-medium leading-6 text-gray-900") }}
            {{ html()->select('todo_category_id', $categories, Request::has('todo_category_id')? Request::get('todo_category_id') : '')->class('w-full form-select')->placeholder('Select category') }}
        </div>
        <div class="col-md-2">
            {{ html()->label('Status')->for('status')->class("block text-sm font-medium leading-6 text-gray-900") }}
            {{ html()->select('status', $statuses, Request::has('status') ? Request::get('status') : '')->class('w-full form-select')->placeholder('Select status') }}
        </div>
        <div class="col-md-2">
            {{ html()->label('Show deleted')->for('show_delete')->class("block text-sm font-medium leading-6 text-gray-900") }}
            {{ html()->select('show_deleted', [true => 'Yes'], Request::has('show_deleted') ? Request::get('show_deleted') : '')->class('w-full form-select')->placeholder('Select show deleted') }}
        </div>
        <div class="col-md-2">
            {{ html()->label('Show only shared items')->for('show_shared')->class("block text-sm font-medium leading-6 text-gray-900") }}
            {{ html()->select('show_shared', [true => 'Yes'], request()->has('show_shared') ? request()->get('show_shared') : '')->class('w-full form-select')->placeholder('Select show shared') }}
        </div>
        <div class="items-center flex">
            {{ html()->button('Filter')->type('submit')->class("flex justify-flex-end rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 mt-3 items-center") }}
        </div>


        {{ html()->form()->close() }}
    </div>
</div>

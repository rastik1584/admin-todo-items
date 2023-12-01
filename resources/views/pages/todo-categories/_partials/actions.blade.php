<div class="inline-flex gap-2">
    <a href="{{ route('todo-categories.edit', $category) }}" class="btn btn-sm btn-primary" title="Edit todo category"><i class="fa fa-pencil" aria-hidden="true"></i></a>

    @if($category->items->count() === 0)
        {{ html()->form('DELETE', route('todo-categories.destroy', $category))->open() }}
            <button type="submit" class="btn btn-sm btn-danger bg-red-500" title="Delete todo category"><i class="fa fa-trash" aria-hidden="true"></i></button>
        {{ html()->form()->close() }}
    @endif
</div>

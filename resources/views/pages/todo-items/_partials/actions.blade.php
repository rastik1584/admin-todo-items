<div class="inline-flex gap-2">
    <a href="{{ route('todo-items.edit', $item) }}" class="btn btn-sm btn-primary" title="Edit todo item"><i class="fa fa-pencil" aria-hidden="true"></i></a>

    @if(is_null($item->deleted_at))
        {{ html()->form('DELETE', route('todo-items.destroy', $item))->open() }}
            <button type="submit" class="btn btn-sm btn-danger bg-red-500" title="Delete todo item" onclick="return confirm(`Are you sure delete this todo item?`)"><i class="fa fa-trash" aria-hidden="true"></i></button>
        {{ html()->form()->close() }}
    @else
        {{ html()->form('POST', route('todo-item.restore'))->open() }}
            {{ html()->hidden('todo_item_id', $item->id) }}
            <button type="submit" class="btn btn-sm btn-warning bg-warning" title="Restore deleted todo item"><i class="fa fa-retweet" aria-hidden="true"></i></button>
        {{ html()->form()->close() }}
    @endif

    <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-warning btn-sm revisar" id="getActualizaId">
        share
    </button>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Share todo item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ html()->form('POST', route('todo-item.share'))->open() }}
                    {{ html()->hidden('todo_item_id', $item->id) }}
                    {{ html()->multiselect('user_id', $users, $shared)->class('form-select') }}

                <div class="mt-2">
                    <button type="button" class="btn btn-sm bg-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm bg-primary">Share</button>
                </div>
                {{ html()->form()->close() }}
            </div>
        </div>
    </div>
</div>

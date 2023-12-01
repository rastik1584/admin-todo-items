<h1>Todo item changed status</h1>

<p>Todo item with name {{ $item['name'] }} changed status to {{ \App\Enums\TodoItemStatusEnum::labels()[$item['status']] }}</p>

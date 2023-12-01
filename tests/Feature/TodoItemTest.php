<?php

namespace Tests\Feature;

use App\Enums\TodoItemStatusEnum;
use App\Events\ChangeTodoItemStatus;
use App\Mail\MailSendTodoItemStatus;
use App\Mail\SendShareTodoItemMail;
use App\Models\TodoCategory;
use App\Models\TodoItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class TodoItemTest extends TestCase
{
    use RefreshDatabase;

    public function testNotAccessShowTodoItemListing()
    {
        $response = $this->get(route('todo-items.index'));

        $response->assertRedirect(route('login.index'));
    }

    public function testCanCreateTodoItem()
    {
        User::factory(5)->create();
        $user = User::inRandomOrder()->first();
        $data = TodoItem::factory([
            'user_id' => $user->id,
        ])->make()->toArray();

        $this->actingAs($user, 'web')
            ->post(route('todo-items.store'), $data)
            ->assertRedirect(route('todo-items.index'))
            ->assertStatus(302);

        $this->assertDatabaseCount('todo_items', 1);
        $this->assertDatabaseHas('todo_items', $data);
    }

    public function testCanUpdateTodoItem()
    {
        User::factory(5)->create();
        $user = User::inRandomOrder()->first();

        $todoItem = TodoItem::factory([
            'user_id' => $user->id,
        ])->create();
        $data = TodoItem::factory([
            'status' => TodoItemStatusEnum::DONE->value
        ])->make()->toArray();

        $this->actingAs($user, 'web')
            ->put(route('todo-items.update', $todoItem), $data)
            ->assertRedirect(route('todo-items.index'))
            ->assertStatus(302);

        $this->assertDatabaseCount('todo_items', 1);
        $data['user_id'] = $user->id;
        $this->assertDatabaseHas('todo_items', $data);
    }

    public function testCanDestroyTodoItem()
    {
        User::factory(5)->create();
        $user = User::inRandomOrder()->first();
        $todoItem = TodoItem::factory(['user_id' => $user->id])->create();

        $this->actingAs($user, 'web')
            ->delete(route('todo-items.destroy', $todoItem))
            ->assertRedirect(route('todo-items.index'))
            ->assertStatus(302);

        $this->assertDatabaseCount('todo_items', 1);
        $this->assertDatabaseHas('todo_items', array_merge($todoItem->toArray(), ['deleted_at' => now()]));
    }

    public function testCanRestoreTodoItem()
    {
        User::factory(5)->create();
        $user = User::inRandomOrder()->first();

        $item = TodoItem::factory()->create();
        $item->delete();
        $item = $item->toArray();

        $this->actingAs($user, 'web')
            ->post(route('todo-item.restore'), ['todo_item_id' => $item['id']])
            ->assertRedirect(route('todo-items.index'))
            ->assertStatus(302);
        $this->assertDatabaseHas('todo_items', array_merge($item, ['deleted_at' => null]));

    }

    public function testShareTodoItem()
    {
        User::factory(5)->create();
        $user = User::inRandomOrder()->first();
        $sharedUsers = User::inRandomOrder()->take(1)->pluck('id')->toArray();

        $item = TodoItem::factory()->create();

        Mail::fake();

        $this->actingAs($user, 'web')
            ->post(route('todo-item.share'), ['todo_item_id' => $item->id, 'user_id' => $sharedUsers])
            ->assertRedirect(route('todo-items.index'))
            ->assertStatus(302);

        Mail::assertSent(SendShareTodoItemMail::class);
        $this->assertDatabaseCount('todo_item_share_relation', 1);
        $this->assertDatabaseHas('todo_item_share_relation', ['todo_item_id' => $item->id, 'user_id' => $sharedUsers[0]]);
    }

    public function testUpdateTodoItemWithSharedOtherUser()
    {
        User::factory(5)->create();
        $user = User::inRandomOrder()->first();
        $shared = User::query()->whereNot('id', $user->id)->inRandomOrder()->first();

        $todoItem = TodoItem::factory([
            'user_id' => $user->id,
        ])->create();

        $todoItem->share()->sync([$shared->id]);

        $data = TodoItem::factory([
            'status' => TodoItemStatusEnum::DONE->value
        ])->make()->toArray();

        Mail::fake();

        $this->actingAs($user, 'web')
            ->put(route('todo-items.update', $todoItem), $data)
            ->assertRedirect(route('todo-items.index'))
            ->assertStatus(302);

        Mail::assertSent(MailSendTodoItemStatus::class);

        $this->assertDatabaseCount('todo_items', 1);
        $data['user_id'] = $user->id;
        $this->assertDatabaseHas('todo_items', $data);
    }
}

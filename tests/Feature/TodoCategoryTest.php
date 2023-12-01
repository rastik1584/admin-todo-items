<?php

namespace Tests\Feature;

use App\Models\TodoCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoCategoryTest extends TestCase
{
    use RefreshDatabase;

    public function testNotAccessShowTodoCategoryListing()
    {
        $response = $this->get(route('todo-categories.index'));

        $response->assertRedirect(route('login.index'));
    }

    public function testCreateTodoCategory()
    {
        User::factory(5)->create();
        $user = User::inRandomOrder()->first();

        $category = TodoCategory::factory()->make()->toArray();
        $this->actingAs($user, 'web')
            ->post(route('todo-categories.store'), $category)
            ->assertRedirect(route('todo-categories.index'))
            ->assertStatus(302);

        $this->assertDatabaseCount('todo_categories', 1);
        $this->assertDatabaseHas('todo_categories',$category);
    }

    public function testUpdateTodoCategory()
    {
        User::factory(5)->create();
        $user = User::inRandomOrder()->first();
        $category = TodoCategory::factory(['user_id' => $user->id])->create();
        $data = TodoCategory::factory()->make()->toArray();

        $this->actingAs($user, 'web')
            ->put(route('todo-categories.update', $category), $data)
            ->assertRedirect(route('todo-categories.index'))
            ->assertStatus(302);

        $this->assertDatabaseCount('todo_categories',1);
        $data['user_id'] = $user->id;
        $this->assertDatabaseHas('todo_categories', $data);
    }

    public function testDestroyTodoCategory()
    {
        User::factory(5)->create();
        $user = User::inRandomOrder()->first();
        $category = TodoCategory::factory(['user_id' => $user->id])->create();

        $this->actingAs($user, 'web')
            ->delete(route('todo-categories.destroy', $category))
            ->assertRedirect(route('todo-categories.index'))
            ->assertStatus(302);

        $this->assertDatabaseCount('todo_categories', 1);
        $this->assertDatabaseHas('todo_categories', array_merge($category->toArray(), ['deleted_at' => now()]));
    }
}

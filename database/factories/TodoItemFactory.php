<?php

namespace Database\Factories;

use App\Enums\TodoItemStatusEnum;
use App\Models\TodoCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TodoItem>
 */
class TodoItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        TodoCategory::factory(5)->create();

        return [
            'name' => fake()->company,
            'description' => fake()->text('250'),
            'status' => TodoItemStatusEnum::IN_PROGRESS->value,
            'todo_category_id' => TodoCategory::query()->inRandomOrder()->value('id'),
            'user_id' => User::query()->inRandomOrder()->value('id'),
        ];
    }
}

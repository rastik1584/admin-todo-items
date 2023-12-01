<?php

namespace App\Http\Requests;

use App\Enums\TodoItemStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreTodoItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'description' => ['string', 'nullable'],
            'user_id' => ['required', 'exists:users,id'],
            'status' => ['required'],
            'todo_category_id' => ['required', 'exists:todo_categories,id'],
        ];
    }
}

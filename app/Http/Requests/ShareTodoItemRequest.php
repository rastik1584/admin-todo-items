<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShareTodoItemRequest extends FormRequest
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
            'todo_item_id' => ['required', 'exists:todo_items,id'],
            'user_id' => ['required', 'array'],
        ];
    }
}

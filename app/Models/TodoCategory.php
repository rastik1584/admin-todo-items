<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TodoCategory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'user_id'];

    public function items(): HasMany
    {
        return $this->hasMany(TodoItem::class, 'todo_category_id');
    }
}

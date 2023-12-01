<?php

namespace App\Models;

use App\Events\ChangeTodoItemStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TodoItem extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'user_id', 'status', 'todo_category_id', 'deleted_at'];

    protected static function boot()
    {
        parent::boot();

        static::updating(function($model) {
            if (self::find($model->id)->status !== $model->status && ! is_null($model->share->count())) {
                event(new ChangeTodoItemStatus($model));
            }
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(TodoCategory::class, 'todo_category_id');
    }

    public function share(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'todo_item_share_relation', 'todo_item_id','user_id');
    }
}

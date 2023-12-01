<?php

namespace App\Enums;

enum TodoItemStatusEnum: string
{
    case CREATED = 'created';
    case IN_PROGRESS = 'in_progress';
    case REVIEW = 'review';
    case DONE = 'done';

    public static function labels(): array
    {
        return [
            self::CREATED->value => ucfirst(self::CREATED->value),
            self::IN_PROGRESS->value => ucfirst(str_replace('_', ' ', self::IN_PROGRESS->value)),
            self::REVIEW->value => ucfirst(self::REVIEW->value),
            self::DONE->value => ucfirst(self::DONE->value),
        ];
    }

}

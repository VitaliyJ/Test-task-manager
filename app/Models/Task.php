<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Task
 * @package App\Models
 * @property int    $id
 * @property string $name
 * @property int    $completed
 * @property string $created_at
 * @property string $updated_at
 */
class Task extends Model
{
    use HasFactory;

    public const COMPLETED_NO = 0;
    public const COMPLETED_YES = 1;

    public function scopeCompleted(Builder $query): Builder
    {
        return $query->where('completed', '=', Task::COMPLETED_YES);
    }

    public function scopeNotCompleted(Builder $query): Builder
    {
        return $query->where('completed', '=', Task::COMPLETED_NO);
    }
}

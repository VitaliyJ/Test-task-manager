<?php

namespace App\Services\TaskServices;

use App\Exceptions\RecordFailedException;
use App\Models\Task;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;

class TaskService
{
    public const COMPLETED_ONLY = 1;
    public const NOT_COMPLETED_ONLY = 0;

    public ?int $completed = null;
    public string $name;

    public function search(): Collection
    {
        return Task::when(
                $this->completed === self::COMPLETED_ONLY,
                function (Builder $query) {
                    $query->completed();
                }
            )
            ->when(
                $this->completed === self::NOT_COMPLETED_ONLY,
                function (Builder $query) {
                    $query->notCompleted();
                }
            )
            ->latest()
            ->get();
    }

    /**
     * @return Collection
     * @throws RecordFailedException
     */
    public function add(): Task
    {
        $task = new Task;
        $task->name = $this->name;

        if (!$task->save()) {
            throw new RecordFailedException();
        }

        return $task;
    }
}

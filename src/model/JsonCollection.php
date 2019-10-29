<?php //src/model/JsonCollection.php
namespace pkpudev\gantt\model;

use pkpudev\gantt\Collection;
use pkpudev\gantt\Task;

class JsonCollection
{
    public $collection;

    public function __construct(Collection $collection)
    {
        $this->collection = $collection;
    }

    public function getData(): array
    {
        if ($this->collection->count() == 0) {
            return [];
        }

        $data = [];
        foreach ($this->collection as $task) {
            $data[] = [
                'id' => $task->id,
                'parent' => $task->parent,
                'text' => $task->text,
                'start_date' => $task->startDate,
                'duration' => (int)$task->duration,
                'progress' => (float)$task->progress,
                'open' => (bool)$task->open,
                'priority' => (int)$task->priority,
                'end_date' => $task->endDate,
                'users' => $task->users,
                'usage' => $task->usage,
            ];
        }
        return $data;
    }
}
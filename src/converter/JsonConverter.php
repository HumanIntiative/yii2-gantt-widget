<?php //src/converter/JsonConverter.php
namespace pkpudev\gantt\converter;

use pkpudev\gantt\model\TaskCollection;

class JsonConverter
{
    protected $taskCollection;

    public function __construct(TaskCollection $taskCollection)
    {
        $this->taskCollection = $taskCollection;
    }

    public function getData(): array
    {
        if ($this->taskCollection->count() == 0) {
            return [];
        }

        $data = [];
        foreach ($this->taskCollection as $task) {
            $data[] = [
                'id' => $task->id,
                'parent' => $task->parent,
                'pic_id' => $task->pic_id,
                'text' => $task->text,
                'start_date' => $task->startDate,
                'duration' => (int)$task->duration,
                'progress' => (float)$task->progress,
                'open' => (bool)$task->open,
                'priority' => (int)$task->priority,
                'end_date' => $task->endDate,
                'users' => $task->users,
                'usage' => $task->usage,
                'order' => (int)$task->order,
            ];
        }
        return $data;
    }
}
<?php //src/Convert_Task.php
namespace pkpudev\gantt;

/**
 * Convert task object to js data string
 * 
 * @param Task $task
 * @param bool $isSubtask
 * @return string
 */
function Convert_task(Task $task, bool $isSubtask=false): string
{
    if ($isSubtask) {
        return sprintf(
            "{ TaskID:%d, TaskName:\"%s\", StartDate:new Date(\"%s\"), Duration:%d, Progress:%d }",
            $task->taskId,
            $task->taskName,
            date('m/d/Y', strtotime($task->startDate)),
            $task->duration,
            $task->progress
        );
    }

    return sprintf(
        "{ TaskID:%d, TaskName:\"%s\", StartDate:new Date(\"%s\"), EndDate:new Date(\"%s\"), subtasks:[ %s ] }",
        $task->taskId,
        $task->taskName,
        date('m/d/Y', strtotime($task->startDate)),
        date('m/d/Y', strtotime($task->endDate)),
        implode(
            ',',
            array_map(
                function ($task) { return Convert_task($task, true); },
                $task->getSubtask()
            )
        )
    );
}
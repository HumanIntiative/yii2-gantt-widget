<?php //src/Gantt/Convert_Task.php
namespace pkpudev\widget\gantt;

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
            "{ TaskID:%d, TaskName:'%s', StartDate:new Date('%s'), Duration:%d, Progress:%d }",
            $task->taskId,
            $task->taskName,
            date('d/m/Y', strtotime($task->startDate)),
            $task->duration,
            $task->progress
        );
    }

    return sprintf(
        "{ TaskID:%d, TaskName:'%s', StartDate:new Date('%s'), EndDate:new Date('%s'), subtasks:[ %s ] }",
        $task->taskId,
        $task->taskName,
        date('d/m/Y', strtotime($task->startDate)),
        date('d/m/Y', strtotime($task->endDate)),
        implode(
            ',',
            array_map(
                function ($task) { return Convert_task($task, true); },
                $task->getSubtask()
            )
        )
    );
}
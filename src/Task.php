<?php //src/Task.php
namespace pkpudev\gantt;

use yii\base\Component;

/**
 * Basic Task for Gantt component
 * 
 * Here is long desc
 *
 * @author Zein Miftah <zeinmiftah@gmail.com>
 * @since 1.0
 */
class Task extends Component
{
    /**
     * @var int $taskId
     */
    public $taskId;
    /**
     * @var string $taskName
     */
    public $taskName;
    /**
     * @var string $startDate
     */
    public $startDate;
    /**
     * @var string $endDate
     */
    public $endDate;
    /**
     * @var int $duration
     */
    public $duration = 0;
    /**
     * @var int $progress
     */
    public $progress = 0;
    /**
     * @var Task[] $subTasks
     */
    protected $subTasks = [];

    public function addSubtask(Task $subTask)
    {
        $this->subTasks[] = $subTask;
    }

    public function getSubtask(): array
    {
        return $this->subTasks;
    }
}
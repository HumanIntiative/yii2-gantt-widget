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
     * @var int $id
     */
    public $id;
    /**
     * @var int $parent
     */
    public $parent;
    /**
     * @var string $text
     */
    public $text;
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
     * @var int $priority
     */
    public $priority = 0;
    /**
     * @var bool $open
     */
    public $open = 1;
    /**
     * @var string[] $usage
     */
    public $usage = [];
    /**
     * @var string[] $users
     */
    public $users = [];

    /**
     * @var Task[] $subTasks
     */
    protected $subTasks = [];

    public function addSubtask(Task $subTask)
    {
        $subTask->parent = $this->id;
        $this->subTasks[] = $subTask;
    }

    public function getSubtask(): array
    {
        return $this->subTasks;
    }
}
<?php //src/Gantt/Collection.php
namespace pkpudev\widget\gantt;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use yii\base\BaseObject;

/**
 * Collection for Gantt task
 * 
 * Here is long desc
 *
 * @author Zein Miftah <zeinmiftah@gmail.com>
 * @since 1.0
 */
class Collection extends BaseObject implements IteratorAggregate, Countable
{
    /**
     * @var array $tasks
     */
    protected $tasks = [];

    public function addTask(Task $task)
    {
        array_push($this->tasks, $task);
    }

    public function getIterator()
    {
        return new ArrayIterator($this->tasks);
    }

    public function count()
    {
        return count($this->tasks);
    }

    public function exists()
    {
        return !empty($this->data);
    }
}
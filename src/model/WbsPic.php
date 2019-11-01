<?php //src/model/WbsProgress.php
namespace pkpudev\gantt\model;

use yii\db\Query;

class WbsPic
{
    protected $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function getValue()
    {
        $row = (new Query)
            ->select('employee_id')
            ->from('pdg.raci')
            ->where(['wbs_id'=>$this->task->id])
            ->one();
        if ($row) {
            return (int)$row['employee_id'];
        }
        return null;
    }

    public static function get(Task $task)
    {
        $static = new static($task);
        return $static->getValue();
    }
}
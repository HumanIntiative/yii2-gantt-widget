<?php //src/model/WbsTransformer.php
namespace pkpudev\gantt\model;

use pkpudev\gantt\Task;
use yii\db\ActiveRecordInterface;

class WbsTransformer
{
    protected $wbsModel;

    public function __construct(ActiveRecordInterface $wbsModel)
    {
        $this->wbsModel = $wbsModel;
    }

    public function transform(): Task
    {
        $match = [
            'id' => 'id',
            'parent' => 'parent_id',
            'text' => 'task_name',
            'startDate' => 'start',
            'endDate' => 'finish',
            'duration' => 'duration',
            'priority' => 'level',
        ];

        $newTask = new Task;
        foreach ($match as $kTask => $kWbs) {
            $newTask->{$kTask} = $this->wbsModel->{$kWbs};
        }
        $newTask->progress = WbsProgress::get($newTask);
        return $newTask;
    }
}
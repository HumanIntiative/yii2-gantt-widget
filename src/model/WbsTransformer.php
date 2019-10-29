<?php //src/model/WbsTransformer.php
namespace pkpudev\gantt\model;

use pkpudev\gantt\Task;
use yii\db\ActiveRecordInterface;

class WbsTransformer
{
    public $wbsModel;

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
            'progress' => 'complete',
            'priority' => 'level',
        ];

        $newTask = new Task;
        foreach ($match as $kTask => $kWbs) {
            $newTask->{$kTask} = $this->wbsModel->{$kWbs};
            /*
            TODO: see pdg.project__wbs_progress
            if ($kTask == 'progress') {
                $newTask->progress = 0.5;
            }*/
        }
        return $newTask;
    }
}
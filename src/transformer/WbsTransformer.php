<?php //src/transformer/WbsTransformer.php
namespace pkpudev\gantt\transformer;

use pkpudev\gantt\model\Task;
use pkpudev\gantt\model\WbsPic;
use pkpudev\gantt\model\WbsProgress;
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
            'order' => 'order_no',
        ];

        $newTask = new Task;
        foreach ($match as $kTask => $kWbs) {
            $newTask->{$kTask} = $this->wbsModel->{$kWbs};
        }
        $newTask->progress = WbsProgress::get($newTask);
        $newTask->pic_id = WbsPic::get($newTask);
        return $newTask;
    }
}
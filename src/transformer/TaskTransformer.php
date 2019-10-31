<?php //src/transformer/TaskTransformer.php
namespace pkpudev\gantt\transformer;

use pkpudev\gantt\model\TaskCollection;
use yii\db\ActiveQueryInterface;

class TaskTransformer
{
    protected $query;

    public function __construct(ActiveQueryInterface $query)
    {
        $this->query = $query;
    }

    public function transform(): TaskCollection
    {
        $data = $this->query->all();

        $newCollection = new TaskCollection;
        foreach ($data as $row) {
            $transformer = new WbsTransformer($row);
            if ($wbs = $transformer->transform()) {
                $newCollection->addTask($wbs);
            }
        }
        return $newCollection;
    }
}
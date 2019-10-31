<?php //src/model/TaskComposer.php
namespace pkpudev\gantt\model;

use app\models\ProjectWbs;

class TaskComposer
{
    protected $projectId;

    public function __construct(int $projectId)
    {
        $this->projectId = $projectId;
    }

    public function compose(): array
    {
        $params = ['project_id'=>$this->projectId];
        $query = ProjectWbs::find()->where($params);

        $transformer = new TaskTransformer($query);
        $collection = $transformer->transform();
        $json = new JsonConverter($collection);
        return $json->getData();
    }
}
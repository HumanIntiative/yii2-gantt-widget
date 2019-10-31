<?php //src/composer/TaskComposer.php
namespace pkpudev\gantt\composer;

use app\models\ProjectWbs;
use pkpudev\gantt\converter\JsonConverter;
use pkpudev\gantt\transformer\TaskTransformer;

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
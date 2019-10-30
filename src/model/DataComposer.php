<?php //src/model/DataComposer.php
namespace pkpudev\gantt\model;

use app\models\ProjectWbs;

class DataComposer
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

        $activeQuery = new ActiveQueryTransformer($query);
        $collection = $activeQuery->transform();
        $json = new JsonCollection($collection);
        return $json->getData();
    }
}
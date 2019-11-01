<?php //src/api/ApiIndex.php
namespace pkpudev\gantt\api;

use pkpudev\gantt\transformer\RequestTransformer;
use Yii;

class ApiUpdate
{
    use RestTrait;

    protected $projectId;
    protected $taskId;

    public function __construct(int $projectId, int $taskId)
    {
        $this->projectId = $projectId;
        $this->taskId = $taskId;
    }

    public function run()
    {
        $request = Yii::$app->request;

        $transformer = new RequestTransformer($this->projectId, $request->post());
        $model = $transformer->getExistingModel($this->taskId);

        if ($model->save()) {
            $this->setHeader(200);
            echo json_encode(['action'=>'updated'], JSON_PRETTY_PRINT);
        } else {
            $this->setHeader(400);
            echo json_encode(['msg'=>'error'], JSON_PRETTY_PRINT);
        }
    }
}
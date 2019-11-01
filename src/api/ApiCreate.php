<?php //src/api/ApiIndex.php
namespace pkpudev\gantt\api;

use pkpudev\gantt\transformer\RequestTransformer;
use Yii;

class ApiCreate
{
    use RestTrait;

    protected $projectId;

    public function __construct(int $projectId)
    {
        $this->projectId = $projectId;
    }

    public function run()
    {
        $request = Yii::$app->request;

        $transformer = new RequestTransformer($this->projectId, $request->post());
        $model = $transformer->getNewModel();

        if ($model->save()) {
            $this->setHeader(201);
            echo json_encode(['action'=>'inserted', 'tid'=>time()], JSON_PRETTY_PRINT);
        } else {
            $this->setHeader(400);
            echo json_encode(['msg'=>'error'], JSON_PRETTY_PRINT);
        }
    }
}
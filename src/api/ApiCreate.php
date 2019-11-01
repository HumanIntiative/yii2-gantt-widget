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
        $model = $transformer->transform();

        var_dump($model->attributes);exit;

        if ($model->save()) {
            $this->setHeader(201);
            echo json_encode(['action'=>'inserted', 'tid'=>time()], JSON_PRETTY_PRINT);
        } else {
            $this->setHeader(201);
            echo json_encode(['msg'=>'error'], JSON_PRETTY_PRINT);
        }
    }
}
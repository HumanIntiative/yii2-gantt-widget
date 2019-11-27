<?php //src/api/ApiIndex.php
namespace pkpudev\gantt\api;

use pkpudev\gantt\model\PicUpdater;
use pkpudev\gantt\model\ProgressUpdater;
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

        $post = $request->post();
        $transformer = new RequestTransformer($this->projectId, $post);
        $model = $transformer->getNewModel();

        $trx = Yii::$app->db->beginTransaction();
        try {
            if ($model->save()) {
                (new PicUpdater($model, (int)$post['pic_id']))->execute();
                (new ProgressUpdater($model, $post['progress']))->execute();
                $trx->commit();

                $this->setHeader(201);
                echo json_encode(['action'=>'inserted', 'tid'=>time()], JSON_PRETTY_PRINT);
            } else {
                $trx->rollBack();

                $this->setHeader(400);
                echo json_encode(['msg'=>'error'], JSON_PRETTY_PRINT);
            }
        } catch (\Throwable $th) {
            $trx->rollBack();
            throw $th;
        }
    }
}

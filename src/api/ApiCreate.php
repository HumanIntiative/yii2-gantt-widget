<?php //src/api/ApiIndex.php
namespace pkpudev\gantt\api;

use Yii;

class ApiCreate
{
    use RestTrait;

    public function run()
    {
        $request = Yii::$app->request;

        var_dump($request->getIsPost());
        var_dump($request->post());
    }
}
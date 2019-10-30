<?php //src/api/GanttApiAction.php
namespace pkpudev\gantt\api;

use Yii;
use yii\base\Action;
use yii\web\ServerErrorHttpException;

class GanttApiAction extends Action
{
    use RestTrait;

    public function init()
    {
        parent::init();
        $this->validateWbsModel();
    }

    public function run()
    {
        $request = Yii::$app->request;

        $action = null;
        if ($request->getIsGet()) {
            $action = new ApiIndex;
        } elseif ($request->getIsPost()) {
            $action = new ApiCreate;
        } elseif ($request->getIsPut()) {
            $action = new ApiUpdate;
        } elseif ($request->getIsDelete()) {
            $action = new ApiDelete;
        }

        if ($action) {
            $action->run();
        } else {
            throw new ServerErrorHttpException('Api Err');
        }
    }
}
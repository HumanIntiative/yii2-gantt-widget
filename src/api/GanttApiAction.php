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
        $req = Yii::$app->request;

        $parser = new PathInfoParser($req->getMethod(), $req->getPathInfo());

        $action = null;
        if ($parser->isActionIndex()) {
            $action = new ApiIndex;
        } elseif ($parser->isActionCreate()) {
            $action = new ApiCreate;
        } elseif ($parser->isActionUpdate()) {
            $action = new ApiUpdate;
        } elseif ($parser->isActionDelete()) {
            $action = new ApiDelete;
        }

        if ($action) {
            $action->run();
        } else {
            throw new ServerErrorHttpException('Api Err');
        }
    }
}
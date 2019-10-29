<?php //src/api/GanttApiAction.php
namespace pkpudev\gantt\api;

use pkpudev\gantt\model\DataComposer;
use Yii;
use yii\base\Action;

class GanttApiAction extends Action
{
    use RestTrait;

    public function init()
    {
        parent::init();

        $WbsExists = class_exists('\app\models\ProjectWbs');
        $WbsProgressExists = class_exists('\app\models\ProjectWbsProgress');

        if (!$WbsExists || !$WbsProgressExists) {
            throw new \Exception("No WBS Model", 123);
        }
    }

    public function run()
    {
        $request = Yii::$app->request;

        $this->setHeader(200);

        if ($pid = $request->getQueryParam('pid')) {
            $dataComposer = new DataComposer($pid);
            $json['data'] = $dataComposer->compose();
            $json['link'] = [];
        } else {
            $json = ['data'=>[], 'link'=>[]];
        }

        echo json_encode($json, JSON_PRETTY_PRINT);
    }
}
<?php //src/model/PicUpdater.php
namespace pkpudev\gantt\model;

use app\models\Raci;
use yii\db\ActiveRecordInterface;

class PicUpdater
{
    const TYPE_RESPONSIBLE = 'R';

    protected $wbsId;
    protected $picId;

    public function __construct(ActiveRecordInterface $model, int $picId)
    {
        $this->wbsId = (int)$model->id;
        $this->picId = $picId;
    }

    public function execute(): bool
    {
        if ($this->picId <= 0) return false;

        $model = Raci::find()
            ->where(['wbs_id'=>$this->wbsId])
            ->one();
        if (is_null($model)) {
            $model = new Raci;
            $model->wbs_id = $this->wbsId;
            $model->raci = self::TYPE_RESPONSIBLE;
        }
        $model->employee_id = $this->picId;
        return (bool)$model->save();
    }
}
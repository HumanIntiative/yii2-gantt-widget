<?php //src/api/PicUpdater.php
namespace pkpudev\gantt\api;

use Yii;
use yii\db\ActiveRecordInterface;

class PicUpdater
{
    const TYPE_RESPONSIBLE = 'R';

    protected $wbsId;
    protected $picId;

    public function __construct(ActiveRecordInterface $model, int $picId)
    {
        $this->wbsId = $model->id;
        $this->picId = $picId;
    }

    public function execute(): bool
    {
        $sql = "INSERT INTO pdg.raci(wbs_id, employee_id, raci) VALUES(:wbs, :employee, :raci)";
        $command = Yii::$app->db->createCommand($sql);
        $command->bindParam(':wbs', $this->wbsId);
        $command->bindParam(':employee', $this->picId);
        $command->bindParam(':raci', self::TYPE_RESPONSIBLE);
        return (bool)$command->execute();
    }
}
<?php //src/model/TeamTransformer.php
namespace pkpudev\gantt\model;

use app\models\ProjectTeam;
use pkpudev\gantt\TeamMember;
use yii\db\ActiveQueryInterface;

class TeamTransformer
{
    protected $activeQuery;

    public function __construct(ActiveQueryInterface $activeQuery)
    {
        $this->activeQuery = $activeQuery;
    }

    public function transform(): array
    {
        $rows = $this->activeQuery->all();
        
        $members = [];
        foreach ($rows as $projectTeam) {
            $newMember = new TeamMember;
            $newMember->memberId = $projectTeam->id;
            $newMember->memberName = $this->getUsername($projectTeam);
            $members[] = $newMember;
        }
        return $members;
    }

    protected function getUsername(ProjectTeam $model)
    {
        $employee = $model->getEmployee()->one();
        return $employee ? $employee->full_name : null;
    }
}
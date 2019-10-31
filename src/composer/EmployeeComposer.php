<?php //src/composer/EmployeeComposer.php
namespace pkpudev\gantt\composer;

use app\models\Employee;
use app\models\ProjectTeam;
use pkpudev\gantt\transformer\MemberTransformer;

class EmployeeComposer
{
    protected $projectId;

    public function __construct(int $projectId)
    {
        $this->projectId = $projectId;
    }

    public function compose(): array
    {
        return $this->getEmployee(
            array_map(
                function ($arr) {
                    return $arr['user_id'];
                },
                $this->getProjectTeam()
            )
        );
    }

    protected function getProjectTeam(): array
    {
        $params = ['project_id'=>$this->projectId];
        $query = ProjectTeam::find()
            ->select('user_id')
            ->where($params)
            ->asArray();

        return $query->all();
    }

    protected function getEmployee(array $ids): array
    {
        $query = Employee::find()
            ->select('id, full_name')
            ->where(['in', 'id', $ids]);

        $transformer = new MemberTransformer($query);
        return $transformer->transform();
    }
}
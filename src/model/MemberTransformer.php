<?php //src/model/MemberTransformer.php
namespace pkpudev\gantt\model;

use app\models\Employee;
use pkpudev\gantt\TeamMember;
use yii\db\ActiveQueryInterface;

class MemberTransformer
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
        foreach ($rows as $employee) {
            $newMember = new TeamMember;
            $newMember->memberId = $employee->id;
            $newMember->memberName = $employee->full_name;
            $newMember->initial = $this->getInitial($employee->full_name);
            $members[] = $newMember;
        }
        return $members;
    }

    protected function getInitial($fullName)
    {
        $words = explode(' ', $fullName);
        $letters = array_map(function ($word) { return strtoupper($word[0]); }, $words);
        return implode('', $letters);
    }
}
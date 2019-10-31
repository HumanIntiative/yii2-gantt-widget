<?php //src/transformer/MemberTransformer.php
namespace pkpudev\gantt\transformer;

use pkpudev\gantt\model\Member;
use yii\db\ActiveQueryInterface;

class MemberTransformer
{
    protected $query;

    public function __construct(ActiveQueryInterface $query)
    {
        $this->query = $query;
    }

    public function transform(): array
    {
        $rows = $this->query->all();

        $members = [];
        foreach ($rows as $employee) {
            $newMember = new Member;
            $newMember->id = $employee->id;
            $newMember->name = $employee->full_name;
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
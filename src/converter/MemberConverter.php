<?php //src/converter/MemberConverter.php
namespace pkpudev\gantt\converter;

use pkpudev\gantt\model\Member;

/**
 * Member Converter
 */
class MemberConverter
{
    protected $members;

    public function __construct(array $members)
    {
        $this->members = $members;
    }

    public function toString(): string
    {
        return implode(
            ',', 
            array_map(
                function (Member $member) {
                    return sprintf(
                        "{key:%s, label:'%s'}",
                        $member->id,
                        $member->name
                    );
                },
                $this->members
            )
        );
    }
}
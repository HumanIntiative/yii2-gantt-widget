<?php //src/model/Converter.php
namespace pkpudev\gantt\model;

class Converter
{
    public static function teamMembersToString(array $members): string
    {
        return implode(
            ',', 
            array_map(
                function (TeamMember $member) {
                    return sprintf(
                        '{key:%s, label:%s}',
                        $member->memberId,
                        $member->memberName
                    );
                }, 
                $members
            )
        );
    }
}
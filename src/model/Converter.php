<?php //src/model/Converter.php
namespace pkpudev\gantt\model;

/**
 * Converter Helper class
 */
class Converter
{
    public static function membersToString(array $members): string
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
                $members
            )
        );
    }
}
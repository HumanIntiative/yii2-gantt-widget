<?php //src/api/GanttUrlRules.php
namespace pkpudev\gantt\api;

use yii\base\Behavior;

/**
 * Gantt Rules
 * 
 * None
 * 
 * @author Zein Miftah <zeinmiftah@gmail.com>
 */
class GanttUrlRules extends Behavior
{
    public $methodName = 'ganttRules';

    public function ganttRules()
    {
        $defaultRule = 'project/project/gantt_api';
        return [
            'project/<pid:\d+>/gantt_api' => $defaultRule,                //GET
            'project/<pid:\d+>/gantt_api/task' => $defaultRule,           //POST
            'project/<pid:\d+>/gantt_api/task/<tid:\d+>' => $defaultRule, //PUT
            'project/<pid:\d+>/gantt_api/task/<tid:\d+>' => $defaultRule, //DELETE
        ];
    }
}
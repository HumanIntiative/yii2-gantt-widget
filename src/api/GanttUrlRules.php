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
            'GET project/<pid:\d+>/gantt_api' => $defaultRule,
            'POST project/<pid:\d+>/gantt_api/task' => $defaultRule,
            'PUT project/<pid:\d+>/gantt_api/task/<tid:\d+>' => $defaultRule,
            'DELETE project/<pid:\d+>/gantt_api/task/<tid:\d+>' => $defaultRule,
        ];
    }
}
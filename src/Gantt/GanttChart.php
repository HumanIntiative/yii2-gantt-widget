<?php //src/Gantt/GanttChart.php
namespace pkpudev\widget\gantt;

use yii\base\Widget;
use yii\web\View;

@require 'Convert_task.php';

/**
 * Gantt widget
 * 
 * Here is long desc
 *
 * @author Zein Miftah <zeinmiftah@gmail.com>
 * @since 1.0
 */
class GanttChart extends Widget
{
    /**
     * @var string $selector
     */
    public $selector = '#ganttId';

    /**
     * @var Collection $ganttData
     */
    public $ganttData;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        // Register bundle
        AssetBundle::register($this->view);
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $irand = rand(0, 1000);
        $ganttData = $this->convertCollection($this->ganttData);
        $script = sprintf(
            "var ganttData = [ %s ];
             var ganttChart = new ej.gantt.Gantt({dataSource: ganttData});
             ganttChart.appendTo(\"%s\");",
            $ganttData,
            $this->selector
        );
        // var_dump($script);
        $this->view->registerJs($script, View::POS_END, "gantt-js{$irand}");
    }

    /**
     * Convert collection to js data string
     * 
     * @param Collection $ganttData
     * @return string
     */
    protected function convertCollection(Collection $ganttData): string
    {
        $tasks = [];
        foreach ($ganttData as $task) {
            array_push($tasks, Convert_task($task, false));
        }
        return implode(',', $tasks);
    }
}
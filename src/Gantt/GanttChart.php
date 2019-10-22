<?php //src/Gantt/GanttChart.php
namespace pkpudev\widget\gantt;

use yii\base\Widget;
use yii\web\View;

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
             ganttChart.appendTo('%s');",
            $ganttData,
            $this->selector
        );
        $this->view->registerJs($script, View::POS_READY, "gantt-js{$irand}");
    }

    /**
     * Convert collection to js data string
     * 
     * @param Collection $ganttData
     * @return string
     */
    protected function convertCollection(Collection $ganttData): string
    {
        return implode(
            ',',
            array_map(
                function ($task) {
                    return Convert_task($task, false);
                },
                (array)$ganttData
            )
        );
    }
}
<?php //src/Gantt/GanttChart.php
namespace pkpudev\widget\gantt;

use pkpudev\widget\gantt\assets\GanttAsset;
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
        GanttAsset::register($this->view);
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $irand = rand(0, 1000);
        $ganttData = $this->convertCollection($this->ganttData);
        $script = sprintf(
            "gantt.message({
                text: \"This example requires a RESTful API on the backend.\",
                expire: -1
            });
            gantt.message({
                text: \"You can also find our step-by-step tutorials for different platforms here\",
                expire: -1
            });
        
            gantt.config.xml_date = \"%Y-%m-%d %H:%i:%s\";
            gantt.init(\"%s\");
            gantt.load(\"/gantt/backend/data\");
        
            var dp = gantt.createDataProcessor({
                url: \"/gantt/backend/data\",
                mode: \"REST\"
            });",
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
<?php //src/GanttChart.php
namespace pkpudev\gantt;

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
     * @var string $apiUrl
     */
    public $apiUrl = '/api';

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
        $script = sprintf(
            "/*gantt.message({
                text: \"This example requires a RESTful API on the backend.\",
                expire: -1
            });*/
        
            gantt.config.xml_date = \"%%Y-%%m-%%d %%H:%%i:%%s\";
            gantt.init(\"%s\");
            gantt.load(\"%s\");
        
            var dp = gantt.createDataProcessor({
                url: \"%s\",
                mode: \"REST\"
            });",
            $this->selector,
            $this->apiUrl,
            $this->apiUrl
        );
        $this->view->registerJs($script, View::POS_END, "gantt-js{$irand}");
    }
}
<?php //src/GanttButton.php
namespace pkpudev\gantt;

use yii\base\Widget;

class GanttButton extends Widget
{
    public $id = 'exportId';
    public $text = 'Export';
    public $type = 'button';
    public $css = 'margin:2px 0px';

    public function run()
    {
        echo '<input
            id="'.$this->id.'"
            value="'.$this->text.'"
            type="'.$this->type.'"
            onclick="gantt.exportToExcel()"
            style="'.$this->css.'" />';
    }
}
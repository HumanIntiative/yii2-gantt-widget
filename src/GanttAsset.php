<?php //src/GanttAsset.php
namespace pkpudev\gantt;

use yii\web\AssetBundle as BaseAssetBundle;
use yii\web\View;

/**
 * Asset bundle for Gantt component
 * 
 * Here is long desc
 *
 * @author Zein Miftah <zeinmiftah@gmail.com>
 * @since 1.0
 */
class GanttAsset extends BaseAssetBundle
{
    public $sourcePath = '@vendor/pkpudev/yii2-gantt-widget';

    public $css = [
        'src/dhtmlx/dhtmlxgantt.css?v=6.2.7',
        // 'src/dhtmlx/skins/dhtmlxgantt_material.css?v=6.2.7',
        'src/assets/style.css',
    ];
    public $jsOptions = [
        'position' => View::POS_BEGIN,
    ];
    public $js = [
        'src/dhtmlx/dhtmlxgantt.js?v=6.2.7',
        'src/dhtmlx/ext/dhtmlxgantt_marker.js?v=6.2.7',
    ];
}
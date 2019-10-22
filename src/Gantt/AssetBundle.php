<?php //src/Gantt/Asset.php
namespace pkpudev\widget\gantt;

use yii\web\AssetBundle as BaseAssetBundle;

/**
 * Asset bundle for Gantt component
 * 
 * Here is long desc
 *
 * @author Zein Miftah <zeinmiftah@gmail.com>
 * @since 1.0
 */
class AssetBundle extends BaseAssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '//cdn.syncfusion.com/ej2/material.css',
        '../App/App.css',
    ];
    public $js = [
        '//cdn.syncfusion.com/ej2/dist/ej2.min.js',
        '../App/GanttChart.js',
    ];
}
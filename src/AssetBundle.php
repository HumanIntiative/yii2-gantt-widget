<?php //src/Gantt/Asset.php
namespace pkpudev\widget\gantt;

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
class AssetBundle extends BaseAssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'App/GanttChart.css',
    ];
    public $jsOptions = [
        'position' => View::POS_HEAD,
    ];
    public $js = [
        'App/GanttChart.js',
    ];
}
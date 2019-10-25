<?php //src/assets/GanttAsset.php
namespace pkpudev\widget\gantt\assets;

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

    public $jsOptions = [
        'position' => View::POS_END,
    ];
    public $js = [
        'src/app/dist/build.js',
    ];
}
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
        '//cdn.syncfusion.com/ej2/ej2-base/styles/material.css',
        '//cdn.syncfusion.com/ej2/ej2-buttons/styles/material.css',
        '//cdn.syncfusion.com/ej2/ej2-popups/styles/material.css',
        '//cdn.syncfusion.com/ej2/ej2-navigations/styles/material.css',
        '//cdn.syncfusion.com/ej2/ej2-lists/styles/material.css',
        '//cdn.syncfusion.com/ej2/ej2-dropdowns/styles/material.css',
        '//cdn.syncfusion.com/ej2/ej2-inputs/styles/material.css',
        '//cdn.syncfusion.com/ej2/ej2-calendars/styles/material.css',
        '//cdn.syncfusion.com/ej2/ej2-layouts/styles/material.css',
        '//cdn.syncfusion.com/ej2/ej2-richtexteditor/styles/material.css',
        '//cdn.syncfusion.com/ej2/ej2-grids/styles/material.css',
        '//cdn.syncfusion.com/ej2/ej2-treegrid/styles/material.css',
        '//cdn.syncfusion.com/ej2/ej2-gantt/styles/material.css',
    ];
    public $jsOptions = [
        'position' => View::POS_HEAD,
    ];
    public $js = [
        '//cdn.syncfusion.com/ej2/ej2-base/dist/global/ej2-base.min.js',
        '//cdn.syncfusion.com/ej2/ej2-data/dist/global/ej2-data.min.js',
        '//cdn.syncfusion.com/ej2/ej2-buttons/dist/global/ej2-buttons.min.js',
        '//cdn.syncfusion.com/ej2/ej2-popups/dist/global/ej2-popups.min.js',
        '//cdn.syncfusion.com/ej2/ej2-navigations/dist/global/ej2-navigations.min.js',
        '//cdn.syncfusion.com/ej2/ej2-lists/dist/global/ej2-lists.min.js',
        '//cdn.syncfusion.com/ej2/ej2-dropdowns/dist/global/ej2-dropdowns.min.js',
        '//cdn.syncfusion.com/ej2/ej2-inputs/dist/global/ej2-inputs.min.js',
        '//cdn.syncfusion.com/ej2/ej2-calendars/dist/global/ej2-calendars.min.js',
        '//cdn.syncfusion.com/ej2/ej2-layouts/dist/global/ej2-layouts.min.js',
        '//cdn.syncfusion.com/ej2/ej2-richtexteditor/dist/global/ej2-richtexteditor.min.js',
        '//cdn.syncfusion.com/ej2/ej2-grids/dist/global/ej2-grids.min.js',
        '//cdn.syncfusion.com/ej2/ej2-treegrid/dist/global/ej2-treegrid.min.js',
        '//cdn.syncfusion.com/ej2/ej2-gantt/dist/global/ej2-gantt.min.js',
    ];
}
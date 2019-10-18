<?php //src/GanttChartAsset.php
namespace pkpudev\widget\gantt;

use yii\web\AssetBundle;

class GanttChartAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '../App/App.css',
    ];
    public $js = [
        '//unpkg.com/react@16.10.2/umd/react.production.min.js',
        '//unpkg.com/react-dom@16.10.2/umd/react-dom.production.min.js',
    ];
}
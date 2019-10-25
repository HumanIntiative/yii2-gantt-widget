<?php //src/assets/VueAsset.php
namespace pkpudev\widget\gantt\assets;

use yii\web\AssetBundle as BaseAssetBundle;
use yii\web\View;

/**
 * Asset bundle for Vue
 * 
 * Here is long desc
 *
 * @author Zein Miftah <zeinmiftah@gmail.com>
 * @since 1.0
 */
class VueAsset extends BaseAssetBundle
{
    public $jsOptions = [
        'position' => View::POS_HEAD,
    ];
    public $js = [
        '//cdn.jsdelivr.net/npm/vue/dist/vue.js',
    ];
}
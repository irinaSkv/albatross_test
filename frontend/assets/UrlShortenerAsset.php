<?php
namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Js и css подключаемые к страницы укоротителя урлов
 */
class UrlShortenerAsset extends AssetBundle
{
    public $sourcePath  = '@frontend/resources';

    public $js = [
        'js/UrlShortenerForm.js',
    ];

    public $css = [
        'css/UrlShortenerForm.css'
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}

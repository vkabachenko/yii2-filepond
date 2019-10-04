<?php


namespace vkabachenko\filepond\assets;

use yii\web\AssetBundle;

class FilepondAsset extends AssetBundle
{
    public $sourcePath = '@npm/filepond';
    public $js = [
        'dist/filepond.min.js'
    ];
    public $css = [
        'dist/filepond.min.css'
    ];
}
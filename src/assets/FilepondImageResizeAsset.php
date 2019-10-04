<?php


namespace vkabachenko\filepond\assets;

use yii\web\AssetBundle;

class FilepondImageResizeAsset extends AssetBundle
{
    public $sourcePath = '@npm/filepond-plugin-image-resize';
    public $js = [
        'dist/filepond-plugin-image-resize.min.js'
    ];
    public $depends = [
        FilepondAsset::class,
    ];
}
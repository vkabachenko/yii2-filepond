<?php


namespace vkabachenko\filepond\assets;

use yii\web\AssetBundle;

class FilepondImageTransformAsset extends AssetBundle
{
    public $sourcePath = '@npm/filepond-plugin-image-transform';
    public $js = [
        'dist/filepond-plugin-image-transform.min.js'
    ];
    public $depends = [
        FilepondAsset::class,
        FilepondImageExifOrientationAsset::class
    ];
}
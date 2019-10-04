<?php


namespace vkabachenko\filepond\assets;

use yii\web\AssetBundle;

class FilepondImageExifOrientationAsset extends AssetBundle
{
    public $sourcePath = '@npm/filepond-plugin-image-exif-orientation';
    public $js = [
        'dist/filepond-plugin-image-exif-orientation.min.js'
    ];
    public $depends = [
        FilepondAsset::class
    ];
}
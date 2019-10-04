<?php


namespace vkabachenko\filepond\assets;

use yii\web\AssetBundle;

class FilepondImageCropAsset extends AssetBundle
{
    public $sourcePath = '@npm/filepond-plugin-image-crop';
    public $js = [
        'dist/filepond-plugin-image-crop.min.js'
    ];
    public $depends = [
        FilepondAsset::class,
    ];
}
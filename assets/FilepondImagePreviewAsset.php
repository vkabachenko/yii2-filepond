<?php


namespace vkabachenko\filepond\assets;

use yii\web\AssetBundle;

class FilepondImagePreviewAsset extends AssetBundle
{
    public $sourcePath = '@npm/filepond-plugin-image-preview';
    public $js = [
        'dist/filepond-plugin-image-preview.min.js'
    ];
    public $css = [
        'dist/filepond-plugin-image-preview.min.css'
    ];
    public $depends = [
        FilepondAsset::class,
        FilepondImageExifOrientationAsset::class
    ];
}
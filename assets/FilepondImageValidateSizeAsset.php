<?php


namespace vkabachenko\filepond\assets;

use yii\web\AssetBundle;

class FilepondImageValidateSizeAsset extends AssetBundle
{
    public $sourcePath = '@npm/filepond-plugin-image-validate-size';
    public $js = [
        'dist/filepond-plugin-image-validate-size.min.js'
    ];
    public $depends = [
        FilepondAsset::class
    ];
}
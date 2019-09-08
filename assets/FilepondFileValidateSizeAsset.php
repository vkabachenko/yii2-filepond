<?php


namespace vkabachenko\filepond\assets;

use yii\web\AssetBundle;

class FilepondFileValidateSizeAsset extends AssetBundle
{
    public $sourcePath = '@npm/filepond-plugin-file-validate-size';
    public $js = [
        'dist/filepond-plugin-file-validate-size.min.js'
    ];
    public $depends = [
        FilepondAsset::class
    ];
}
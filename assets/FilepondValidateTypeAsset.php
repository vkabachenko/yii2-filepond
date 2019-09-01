<?php


namespace vkabachenko\filepond\assets;

use yii\web\AssetBundle;

class FilepondValidateTypeAsset extends AssetBundle
{
    public $sourcePath = '@npm/filepond-plugin-file-validate-type';
    public $js = [
        'dist/filepond-plugin-file-validate-type.min.js'
    ];
    public $depends = [
        FilepondAsset::class
    ];
}
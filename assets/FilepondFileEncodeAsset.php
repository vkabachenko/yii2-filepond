<?php


namespace vkabachenko\filepond\assets;

use yii\web\AssetBundle;

class FilepondFileEncodeAsset extends AssetBundle
{
    public $sourcePath = '@npm/filepond-plugin-file-encode';
    public $js = [
        'dist/filepond-plugin-file-encode.min.js'
    ];
    public $depends = [
        FilepondAsset::class
    ];
}
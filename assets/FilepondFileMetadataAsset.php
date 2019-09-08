<?php


namespace vkabachenko\filepond\assets;

use yii\web\AssetBundle;

class FilepondFileMetadataAsset extends AssetBundle
{
    public $sourcePath = '@npm/filepond-plugin-file-metadata';
    public $js = [
        'dist/filepond-plugin-file-metadata.min.js'
    ];
    public $depends = [
        FilepondAsset::class
    ];
}
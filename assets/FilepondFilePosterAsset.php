<?php


namespace vkabachenko\filepond\assets;

use yii\web\AssetBundle;

class FilepondFilePosterAsset extends AssetBundle
{
    public $sourcePath = '@npm/filepond-plugin-file-poster';
    public $js = [
        'dist/filepond-plugin-file-poster.min.js'
    ];
    public $css = [
        'dist/filepond-plugin-file-poster.min.css'
    ];
    public $depends = [
        FilepondAsset::class
    ];
}
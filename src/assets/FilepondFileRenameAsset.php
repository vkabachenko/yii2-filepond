<?php


namespace vkabachenko\filepond\assets;

use yii\web\AssetBundle;

class FilepondFileRenameAsset extends AssetBundle
{
    public $sourcePath = '@npm/filepond-plugin-file-rename';
    public $js = [
        'dist/filepond-plugin-file-rename.min.js'
    ];
    public $depends = [
        FilepondAsset::class
    ];
}
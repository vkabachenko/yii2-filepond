<?php


namespace vkabachenko\filepond\assets;

use yii\web\AssetBundle;

class FilepondImageEditAsset extends AssetBundle
{
    public $sourcePath = '@npm/filepond-plugin-image-edit';
    public $js = [
        'dist/filepond-plugin-image-edit.min.js'
    ];
    public $depends = [
        FilepondAsset::class,
        FilepondImagePreviewAsset::class
    ];
}
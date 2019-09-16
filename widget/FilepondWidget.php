<?php


namespace vkabachenko\filepond\widget;

use vkabachenko\filepond\assets\FilepondAsset;
use vkabachenko\filepond\assets\FilepondFileEncodeAsset;
use vkabachenko\filepond\assets\FilepondFileMetadataAsset;
use vkabachenko\filepond\assets\FilepondFilePosterAsset;
use vkabachenko\filepond\assets\FilepondFileRenameAsset;
use vkabachenko\filepond\assets\FilepondFileValidateSizeAsset;
use vkabachenko\filepond\assets\FilepondFileValidateTypeAsset;
use vkabachenko\filepond\assets\FilepondImageCropAsset;
use vkabachenko\filepond\assets\FilepondImageEditAsset;
use vkabachenko\filepond\assets\FilepondImageExifOrientationAsset;
use vkabachenko\filepond\assets\FilepondImagePreviewAsset;
use vkabachenko\filepond\assets\FilepondImageResizeAsset;
use vkabachenko\filepond\assets\FilepondImageTransformAsset;
use vkabachenko\filepond\assets\FilepondImageValidateSizeAsset;
use vkabachenko\filepond\assets\FilepondValidateTypeAsset;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\widgets\InputWidget;

class FilepondWidget extends InputWidget
{
    public $moduleId = 'filepond';
    public $filepondClass = 'filepond';
    public $multiple = false;
    public $instanceOptions = [];
    public $settingsOptions = [];
    public $language;

    private $encodedInstanceOptions;

    public function init()
    {
        $this->language = $this->language ?? \Yii::$app->language;
        $this->options = [
            'class' => $this->filepondClass,
            'multiple' => $this->multiple,
        ];

        $this->configureInstanceOptions();
        $this->encodedInstanceOptions = Json::encode($this->instanceOptions);

        $this->settingsOptions['server'] = [
            'process' =>  Url::to(['/' . $this->moduleId . '/main/upload']),
            'revert' => Url::to(['/' . $this->moduleId . '/main/delete'])
        ];
        $this->settingsOptions = Json::encode($this->settingsOptions);
    }

    public function run()
    {
        $this->registerClientScript();

        $input = $this->hasModel()
            ? Html::activeFileInput($this->model, $this->attribute, $this->options)
            : Html::fileInput($this->name, $this->value, $this->options);

        return $input;
    }



    private function registerClientScript()
    {
        $view = $this->getView();

        $this->registerAssets($view);

        $script = <<<JS
            var instanceOptions = {$this->encodedInstanceOptions};
            var settingsOptions = {$this->settingsOptions};

            if (instanceOptions.allowFileTypeValidation) {
                FilePond.registerPlugin(FilePondPluginFileValidateType);
            }
            
            FilePond.setOptions(settingsOptions);
            var inputElement = document.querySelector('.' + '{$this->filepondClass}');
            FilePond.create(inputElement, instanceOptions);
JS;
        
        $view->registerJs($script);
    }

    private function configureInstanceOptions()
    {
        $this->instanceOptions['allowMultiple'] = false; // manually add files to filepond only one by one
        $this->instanceOptions['allowFileEncode'] = $this->instanceOptions['allowFileEncode'] ?? false;
        $this->instanceOptions['allowFileMetadata'] = $this->instanceOptions['allowFileMetadata'] ?? false;
        $this->instanceOptions['allowFilePoster'] = $this->instanceOptions['allowFilePoster'] ?? false;
        $this->instanceOptions['allowFileRename'] = $this->instanceOptions['allowFileRename'] ?? false;
        $this->instanceOptions['allowFileSizeValidation'] = $this->instanceOptions['allowFileSizeValidation'] ?? false;
        $this->instanceOptions['allowFileTypeValidation'] = $this->instanceOptions['allowFileTypeValidation'] ?? false;
        $this->instanceOptions['allowImageExifOrientation'] = $this->instanceOptions['allowImageExifOrientation'] ?? false;
        $this->instanceOptions['allowImageCrop'] = $this->instanceOptions['allowImageCrop'] ?? false;
        $this->instanceOptions['allowImageEdit'] = $this->instanceOptions['allowImageEdit'] ?? false;
        $this->instanceOptions['allowImagePreview'] = $this->instanceOptions['allowImagePreview'] ?? false;
        $this->instanceOptions['allowImageResize'] = $this->instanceOptions['allowImageResize'] ?? false;
        $this->instanceOptions['allowImageValidateSize'] = $this->instanceOptions['allowImageValidateSize'] ?? false;
        $this->instanceOptions['allowImageTransform'] = $this->instanceOptions['allowImageTransform'] ?? false;

        $translateOptions = $this->configureTranslate();
        $this->instanceOptions = array_merge($translateOptions, $this->instanceOptions);
    }

    private function configureTranslate()
    {
        $translateFile = __DIR__ . '/messages/' . $this->language . '/app.php';

        if (file_exists($translateFile)) {
            $translate = require $translateFile;
        } else {
            $translate = [];
        }
        return $translate;
    }

    private function registerAssets($view)
    {
        FilepondAsset::register($view);

       if ($this->instanceOptions['allowFileEncode']) {
            FilepondFileEncodeAsset::register($view);
        }

        if ($this->instanceOptions['allowFileMetadata']) {
            FilepondFileMetadataAsset::register($view);
        }

        if ($this->instanceOptions['allowFilePoster']) {
            FilepondFilePosterAsset::register($view);
        }

        if ($this->instanceOptions['allowFileRename']) {
            FilepondFileRenameAsset::register($view);
        }

        if ($this->instanceOptions['allowFileSizeValidation']) {
            FilepondFileValidateSizeAsset::register($view);
        }

        if ($this->instanceOptions['allowFileTypeValidation']) {
            FilepondFileValidateTypeAsset::register($view);
        }

        if ($this->instanceOptions['allowImageExifOrientation']) {
            FilepondImageExifOrientationAsset::register($view);
        }

        if ($this->instanceOptions['allowImageValidateSize']) {
            FilepondImageValidateSizeAsset::register($view);
        }

        if ($this->instanceOptions['allowImageCrop']) {
            FilepondImageCropAsset::register($view);
        }

        if ($this->instanceOptions['allowImageResize']) {
            FilepondImageResizeAsset::register($view);
        }

        if ($this->instanceOptions['allowImagePreview']) {
            FilepondImagePreviewAsset::register($view);
        }
        
        if ($this->instanceOptions['allowImageTransform']) {
            FilepondImageTransformAsset::register($view);
        }

        if ($this->instanceOptions['allowImageEdit']) {
            FilepondImageEditAsset::register($view);
        }
    }

}
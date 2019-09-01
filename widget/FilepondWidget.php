<?php


namespace vkabachenko\filepond\widget;

use vkabachenko\filepond\assets\FilepondAsset;
use vkabachenko\filepond\assets\FilepondValidateTypeAsset;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\widgets\InputWidget;

class FilepondWidget extends InputWidget
{
    public $moduleId = 'filepond';
    public $multiple = false;
    public $allowFileTypeValidation = false;
    public $acceptedFileTypes = [];

    public function init()
    {
        $this->options = [
            'class' => 'filepond',
            'multiple' => $this->multiple,
        ];
        $this->acceptedFileTypes = Json::encode($this->acceptedFileTypes);
        $this->allowFileTypeValidation = Json::encode($this->allowFileTypeValidation);
    }

    public function run()
    {
        $this->registerClientScript();

        $input = $this->hasModel()
            ? Html::activeFileInput($this->model, $this->attribute, $this->options)
            : Html::fileInput($this->name, $this->value, $this->options);

        return $input;
    }

    protected function registerClientScript()
    {
        $view = $this->getView();

        FilepondAsset::register($view);
        if (Json::decode($this->allowFileTypeValidation)) {
            FilepondValidateTypeAsset::register($view);
        }

        $urlProcess = Url::to(['/' . $this->moduleId . '/main/upload']);
        $urlRevert = Url::to(['/' . $this->moduleId . '/main/delete']);

        $script = <<<JS
            if ({$this->allowFileTypeValidation}) {
                FilePond.registerPlugin(FilePondPluginFileValidateType);
            }
            
            FilePond.setOptions({
                server: {
                    process: '{$urlProcess}',
                    revert: '{$urlRevert}'
                }
            });
            var inputElement = document.querySelector('.filepond');
            FilePond.create(inputElement, {
                allowFileTypeValidation: {$this->allowFileTypeValidation},
                acceptedFileTypes: {$this->acceptedFileTypes}
            });
JS;
        
        $view->registerJs($script);
    }

}
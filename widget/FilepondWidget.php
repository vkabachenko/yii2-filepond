<?php


namespace vkabachenko\filepond\widget;

use vkabachenko\filepond\assets\FilepondAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\InputWidget;

class FilepondWidget extends InputWidget
{
    public $moduleId = 'filepond';

    public function init()
    {
        $this->options = [
            'class' => 'filepond'
        ];
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

        $urlProcess = Url::to(['/' . $this->moduleId . '/main/upload']);
        $urlRevert = Url::to(['/' . $this->moduleId . '/main/delete']);

        $script = <<<JS
            FilePond.setOptions({
                server: {
                    process: '{$urlProcess}',
                    revert: '{$urlRevert}'
                }
            });
            var inputElement = document.querySelector('.filepond');
            FilePond.create(inputElement);
JS;
        $view->registerJs($script);
    }

}
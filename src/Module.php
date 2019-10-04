<?php

namespace vkabachenko\filepond;

class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = '\vkabachenko\filepond\controllers';

    public $basePath = '@runtime/temp-upload/';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        $this->basePath = \Yii::getAlias($this->basePath);
    }
}

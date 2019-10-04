<?php

namespace vkabachenko\filepond\controllers;

use yii\filters\VerbFilter;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\UploadedFile;

/**
 * Default controller for the `filepond` module
 */
class MainController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'upload' => ['post'],
                    'delete' => ['delete'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;

        return parent::beforeAction($action);
    }

    /**
     * @return string
     * @throws \yii\base\Exception
     */
    public function actionUpload()
    {
        $post = \Yii::$app->request->post();
        reset($post);
        $fileName = key($post);
        $attribute = \Yii::$app->request->post($fileName);
        if (is_array($attribute)) {
            reset($attribute);
            $key = key($attribute);
            $fileName .= '[' . $key . ']' . (is_array($attribute[$key]) ? '[0]' : '');
        }

        $file = UploadedFile::getInstanceByName($fileName);

        $filePath = \Yii::$app->security->generateRandomString();
        FileHelper::createDirectory($this->module->basePath . $filePath);

        $file->saveAs($this->module->basePath . $filePath . '/' . $file->name);

        return $filePath;
    }

    /**
     * @return string
     * @throws \yii\base\ErrorException
     */
    public function actionDelete()
    {
        $filePath = \Yii::$app->request->getRawBody();
        FileHelper::removeDirectory($this->module->basePath . $filePath);

        return '';
    }

}

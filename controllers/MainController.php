<?php

namespace app\modules\filepond\controllers;

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


    /**
     * @return string
     * @throws \yii\base\Exception
     */
    public function actionUpload()
    {
        $file = UploadedFile::getInstanceByName('file');

        $filePath = \Yii::$app->security->generateRandomString();

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

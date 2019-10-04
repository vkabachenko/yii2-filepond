## Uploading file without model

In controller and view you must specify a temporary file name. Filepond will create temporary directory where to upload the file.

View

```
    <?php Html::beginForm(['upload/store']); ?>
    .......
        <?= FilepondWidget::widget([
                'name' => 'file',
             ]);
        ?>
    .......
    <?php Html::endForm(); ?>
```

Controller

```
    public function actionStore() 
    {
        $fileDir = \Yii::$app->request->post('file');
        $path = \Yii::$app->getModule('filepond')->basePath . $fileDir;
        // uploaded file is in the $path directory
        .......
    }
```
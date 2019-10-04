## Uploading multiple files without model

In controller and view you must specify a temporary files name as array. Filepond will create temporary directory for each uploaded file.

View

```
    <?php Html::beginForm(['upload/store']); ?>
    .......
        <?= FilepondWidget::widget([
                'name' => 'file[]',
                'multiple' => true
             ]);
        ?>
    .......
    <?php Html::endForm(); ?>
```

Controller

```
    public function actionStore() 
    {
            $fileDirs = \Yii::$app->request->post('file');
            foreach ($fileDirs as $fileDir) {
                $path = \Yii::$app->getModule('filepond')->basePath . $fileDir;
                // uploaded file is in the $path directory
                .......
            }
    }
```
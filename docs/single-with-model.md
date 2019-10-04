## Uploading file with model

File validation is inside the widget, not model.

Model

```
class UploadFileForm extends Model
{
    public $file;

    public function rules()
    {
        return [
            [
                ['file'], 'string'
            ],
        ];
    }
}
```


View

```
    <?php $form = ActiveForm::begin(['upload/store']) ?>

        <?= FilepondWidget::widget([
            'model' => $uploadForm,
            'attribute' => 'file',
        ]); ?>
    .......

    <?php ActiveForm::end() ?>
```

Controller

```
    public function actionStore() 
    {
        $uploadForm = new UploadFileForm();
        $uploadForm->load(\Yii::$app->request->post());
        $fileDir = $uploadForm->file;
        $path = \Yii::$app->getModule('filepond')->basePath . $fileDir;
        // uploaded file is in the $path directory
        .......
    }
```
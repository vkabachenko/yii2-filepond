## Uploading multiple files with model

Files validation is inside the widget, not model.

Model

```
class MultipleUploadFileForm extends Model
{
    /**
    * @var array
    */
    public $files;


    public function rules()
    {
        return [
            [
                ['files'], 'each', 'rule' => ['string']
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
            'attribute' => 'files[]',
            'multiple' => true
        ]); ?>

    <?php ActiveForm::end() ?>
```

Controller

```
    public function actionStore() 
    {
        $uploadForm = new MultipleUploadFileForm();
        $uploadForm->load(\Yii::$app->request->post());
        $fileDirs = $uploadForm->files;
        foreach ($fileDirs as $fileDir){
            if (!empty($fileDir)) {
                $path = \Yii::$app->getModule('filepond')->basePath . $fileDir;
                // uploaded file is in the $path directory
                .......
            }
        }
    }
```
# Filepond Yii2 extension

This extension allows you to use [Filepond upload js library](https://pqina.nl/filepond/) as a widget in yii2 projects.

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require  vkabachenko/yii2-filepond
```

or add

```
"vkabachenko/yii2-filepond": "dev-master"
```

to the require section of your `composer.json` file.

## Usage

Add the extension to the `module` section in your config file

```
    'modules' => [
       'filepond' => [
           'class' => \vkabachenko\filepond\Module::class
       ]
    ],
``` 

After that you can use Filepond library to upload files in your project.

[Single file upload without model](docs/single-without-model.md) 

[Single file upload with model](docs/single-with-model.md)

[Multiple files upload without model](docs/multiple-without-model.md) 

[Multiple files upload with model](docs/multiple-with-model.md)

### Filepond options

Filepond options described at the [documentation](https://pqina.nl/filepond/docs/) can be set by two ways.

This is the preferred way:

```
    <?= FilepondWidget::widget([
            'name' => 'file',
            'instanceOptions' => [
                'required' => true,
                'maxFiles' => 10,
                ... other options ...
            ]
         ]);
    ?>
```

### Filepond plugins ###

If you want to add some of filepond plugins to the widget, set the allow plugin option to `true`. For example, to add file type validation plugin set `allowFileSizeValidation`:

```
    <?= FilepondWidget::widget([
            'name' => 'file',
            'instanceOptions' => [
                'allowFileSizeValidation' => true,
                'maxFileSize' => 10M,
                ... other options ...
            ]
         ]);
    ?>
```

### Validation

Only client-side validation is available. This kind of validation is the part of filepond library. You can add file size and file type validation. Example of file type validation:

```
    <?= FilepondWidget::widget([
            'name' => 'file',
            'instanceOptions' => [
                'allowFileTypeValidation' => true,
                'acceptedFileTypes' => ['image/*']
            ]
                ... other options ...
            ]
         ]);
    ?>
```

### Localization

Original library isn't localized and has only english labels. This widget has russian translations too. To apply the localization you have to set `language` option in `Yii` settings or directly in the widget:

```
    <?= FilepondWidget::widget([
            'name' => 'file',
            'language' => 'ru-RU'
         ]);
    ?>
```



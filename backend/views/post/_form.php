<?php

use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use common\models\Tag;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
$data = [];
$tagList = Tag::find()->all();

$data = ArrayHelper::map($tagList, 'name', 'name');
?>

<div class="post-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'image')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
            'bsVersion' => '3.x',
            'pluginOptions' => [
                'maxFileCount' => 1,
                'allowedFileExtensions' => ['jpg','gif','png'],
                'showBrowse' => true,
                'showCaption' => true,
                'showRemove' => false,
                'showUpload' => false,
                'showPreview' => true,
                'initialPreview' => $model->preview,
                'layoutTemplates' => ['footer'=>'<div></div>']
            ]
        ]); ?>

    </div>
    <div class="box-footer">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<?php

use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use common\models\Tag;
use yii\bootstrap4\Modal;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
$data = [];
$tagList = Tag::find()->all();

$data = ArrayHelper::map($tagList, 'name', 'name');

$this->registerJs( <<< EOT_JS_CODE

$("#tag-form").submit( function(e){
    var form = $(this);
    $.ajax({
            url    : 'tag-create',
            type   : 'POST',
            data   : form.serialize(),
            success: function (response) 
            {                  
                $("#modal-alert").html('<div class="alert alert-success" role="alert">' + response.msg + '</div>');
            },
            error  : function (e) 
            {
                $("#modal-alert").html('<div class="alert alert-danger" role="alert">При сохранении произошла ошибка, свяжитесь с администратором ресурса.</div>');
            }
    });
    return false;        
})

EOT_JS_CODE
);
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

    <div class="row">
        <div class="col-10">
                <?=  $form->field($model, 'tagValues')->widget(Select2::classname(), [
                    'data' => $data,
                    'options' => [
                        'placeholder' => 'Выбрать теги ...', 
                        'multiple' => true,
                        'value' => $model->getTagValues(true)
                    ],
                    'showToggleAll' => false,
                    'pluginOptions' => [
                        'tags' => true,
                        'tokenSeparators' => [',', ' '],
                        'maximumSelectionLength' => 5
                    ],
                ])->label('Теги'); ?>
        </div>
        <div class="col-2">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tag-modal">Добавить тег</button>
        </div>
    </div>
    <div class="box-footer">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
    <?php
        Modal::begin([
            'id' => 'tag-modal',
            'title' => 'Новый тег',
        ]);

        echo '<div id="modal-alert"></div>';

        $tagForm = ActiveForm::begin([
            'id'=> 'tag-form',
            'enableAjaxValidation' => true,
        ]);

        echo $tagForm->field($modelTag, 'name');

        echo Html::submitButton('Отправить', ['class' => 'btn btn-success']);

        ActiveForm::end();
                
        Modal::end();
    ?>
</div>

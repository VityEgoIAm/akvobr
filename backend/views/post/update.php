<?php

/* @var $this yii\web\View */
/* @var $model common\models\Post */

$this->title = 'Редактирование поста #: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Посты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="post-update">

    <?= $this->render('_form', [
        'model' => $model,
        'modelTag' => $modelTag,
    ]) ?>

</div>

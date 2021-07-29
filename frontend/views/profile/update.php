<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UserInfo */

$this->title = 'Редактирование своего профиля';
$this->params['breadcrumbs'][] = ['label' => 'Профиль', 'url' => ['view']];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="user-info-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

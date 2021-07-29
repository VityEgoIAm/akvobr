<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\UserInfo */

$this->title = $model->name;
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-info-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'surname',
            'name',
            'patronymic',
            [
                'label' => 'Возраст',
                'value' => (!empty($model->birth_date)) ? floor((time() - strtotime($model->birth_date)) / 31556926). ' лет' : NULL,
            ],
            'created_at:datetime',
            [
                'label' => 'Изображение',
                'value'=> (!empty($model->img_url)) ? $model->img_url : NULL,
                'format' => ['image',['width'=>'100','height'=>'100']],
            ],
        ],
    ]) ?>

</div>

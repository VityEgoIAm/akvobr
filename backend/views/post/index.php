<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index box box-primary">
    <div class="box-header with-border">
        <?= Html::a('Новый пост', ['create'], ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <div class="box-body table-responsive">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
                ['class' => 'kartik\grid\SerialColumn'],

                [
                    'attribute' => 'photo',
                    'format' => ['image',['width'=>'100','height'=>'100']],
                    'value' => function ($data) {
                        return (!empty($data->photo)) ? $data->photo : NULL;
                    },
                ],
                'body:ntext',

                ['class' => 'kartik\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = '文章管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a('创建文章', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn'
            ],
            'title',
            'tags:ntext',
            [
                'attribute'=>'author_id',
                'value' => 'author.username',
            ],
            [
              'attribute'=>'status',
              'filter' => $searchModel->getAllStatus(),
              'value'  =>'pStatus.name'
            ],
            [
                'attribute'=>'update_time',
                'format'=>['date','php:Y-m-d H:i:s']
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
        'emptyText'=>'当前没有文章',
        'emptyTextOptions'=>['style'=>'color:red;font-weight:bold;'],
        'showOnEmpty'=>false,
    ]); ?>
</div>

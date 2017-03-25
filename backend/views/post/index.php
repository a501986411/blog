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
                'header'=>'序号',
                'class' => 'yii\grid\SerialColumn'
            ],
            'title',
            [
                'attribute'=>'tags',
                'contentOptions'=>['width'=>'30px']
            ],
            [
                'attribute'=>'author_id',
                'value' => 'author.username',
                'contentOptions'=>['width'=>'30px','text-align'=>'center']
            ],
            [
              'attribute'=>'status',
              'filter' => $searchModel->getAllStatus(),
              'value'  =>'pStatus.name',
               'contentOptions'=>['width'=>'110px']
            ],
            [
                'attribute'=>'update_time',
                'format'=>['date','php:Y-m-d H:i:s']
            ],
            [
                'header'=>'操作',
                'class' => 'yii\grid\ActionColumn'
            ],
        ],
        'emptyText'=>'当前没有文章',
        'emptyTextOptions'=>['style'=>'color:red;font-weight:bold;'],
        'showOnEmpty'=>false,
    ]); ?>
</div>

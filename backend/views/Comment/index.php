<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '评论管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'header'=>'序号',
            ],
            'content:ntext',
            [
                'attribute'=>'status',
                'value'=>'cStatus.name'
            ],
             [
                 'attribute'=>'create_time',
                 'format'=>['date','php:Y-m-d H:i:s']
             ],
            [
                'attribute'=>'userid',
                'value'=>'user.username'
            ],
            [
                'attribute'=>'post_id',
                'value'=>'post.title'
            ],
            [
                'header'=>'操作',
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {delete} {approve}',
                'buttons'=>[
                        'approve'=>function($url,$model,$key){
                        return $model->status == 1 ? Html::a('<span class="glyphicon glyphicon-check"></span>',$url,['title'=>'审核']):'';
                    },
                ]
            ],
        ],
        'emptyText'=>'当前没有没有评论',
        'emptyTextOptions'=>['style'=>'color:red;font-weight:bold;'],
        'showOnEmpty'=>false,
    ]); ?>
</div>

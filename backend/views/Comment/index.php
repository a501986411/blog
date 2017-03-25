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
                'contentOptions'=>['width'=>'50px'],
            ],
            [
                'attribute'=>'content',
                 'value'=>'beginning',
                 'contentOptions'=>['width'=>'80px'],
            ],
            [
                'attribute'=>'status',
                'value'=>'cStatus.name',
                'contentOptions'=> function($model){
                    $style['width'] = '110px';
                    $style['class'] = ($model->status == 1) ? 'bg-danger':[];
                    return $style;
                },
                'filter'=>\common\models\CommentStatus::find()->select(['name','id'])->indexBy('id')->column()
            ],
            [
                'label'=>'作者',
                'attribute'=>'user.username',
                'contentOptions'=>['width'=>'130px'],
            ],
            [
                'attribute'=>'post.title',
                'contentOptions'=>['width'=>'130px'],
            ],
            [
                'attribute'=>'create_time',
                'format'=>['date','php:Y-m-d H:i:s'],
                'contentOptions'=>['width'=>'100px'],
            ],
            [
                'header'=>'操作',
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {delete} {approve}',
                'buttons'=>[
                        'approve'=>function($url,$model,$key){
                        $options = [
                            'title' =>Yii::t('yii','审核'),
                            'aria-label'=>Yii::t('yii','审核'),
                            'data-confirm'=>Yii::t('yii','你确定通过这条评论吗?'),
                            'data-method'=>'post',
                            'data-pjax'=>'0'
                        ];
                        return $model->status == 1 ? Html::a('<span class="glyphicon glyphicon-check"></span>',$url,$options):'';
                    },
                    'delete'=>function($url,$model,$key){
                        $options = [
                            'title' =>Yii::t('yii','审核'),
                            'aria-label'=>yii::t('yii','删除'),
                            'data-confirm'=>yii::t('yii','你确定删除这条评论吗?'),
                            'data-method'=>'post',
                            'data-pjax'=>'0'
                        ];
                        return $model->status != 3 ? Html::a('<span class="glyphicon glyphicon-trash"></span>',$url,$options) : '';
                    }
                ],
                  'contentOptions'=>['width'=>'40px'],
            ],
        ],
        'emptyText'=>'当前没有没有评论',
        'emptyTextOptions'=>['style'=>'color:red;font-weight:bold;'],
        'showOnEmpty'=>false,
    ]); ?>
</div>

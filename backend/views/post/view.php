<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '文章管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">

    <h1><?= Html::encode($this->title)?></h1>
    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '你确定删除这篇文章吗?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'description:ntext',
            'content:ntext',
            'tags:ntext',
//            'status',
            [
                'label' => '状态',
                'value' => $model->pStatus->name
            ],
            'create_time:datetime',
            'update_time:datetime',
            'attributes' =>[
                'label'=>'作者',
                'value'=>$model->author->username
            ],
//            'author_id',
        ],
        'template'=>'<tr><th style="width: 100px;text-align: center;">{label}</th><td style="text-align: center;">{value}</td></tr>',
        'options'=>['class' => 'table table-striped table-bordered detail-view']
    ]) ?>

</div>

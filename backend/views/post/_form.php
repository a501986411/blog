<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 4,'col'=>20]) ?>
    <?= $form->field($model, 'content')->textarea(['rows' => 30]) ?>

    <?= $form->field($model, 'tags')->textarea(['rows' =>2]) ?>

    <?= $form->field($model, 'status')->dropDownList($model->allStatus,['prompt'=>'请选择'])?>
    <?= $form->field($model, 'author_id')->dropDownList($model->allAuthor,['prompt'=>'请选择'])?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '保存' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

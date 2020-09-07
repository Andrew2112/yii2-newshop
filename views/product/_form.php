<?php

use kartik\rating\StarRating;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Reviews */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reviews-form">
    <?php Pjax::begin(); ?>
    <?php $form = ActiveForm::begin([

        'options' => ['data' => ['pjax' => true]],
    ]); ?>


    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'post')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'rating')->widget(StarRating::class, [
        'pluginOptions' => ['size' => 'xs']
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>
</div>

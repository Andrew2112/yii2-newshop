<?php

use app\models\Subscribe;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Subscribe */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subscribe-form">

    <?php $form = ActiveForm::begin([
        'fieldConfig' => [
            'template' => "
                <div class='col-md-6'>
                <p>{label}</p> \n {input} \n
                <div>{error}</div>
                </div>
                "
        ]
    ]); ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'type' => 'email']) ?>

    <?= $form->field($model, 'active')->dropDownList(Subscribe::statusList()) ?>

    <div class="form-group">
        <div class="col-md-12">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

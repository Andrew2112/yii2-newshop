<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm
?>
<div class="login-box">
    <div class="login-logo">
        <b>Admin</b>LTE
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'username', ['template' => "<div class='form-group has-feedback'>{input}<span class=\"glyphicon glyphicon-user form-control-feedback\"></span><div>{error}</div></div>"])->textInput(['placeholder' => 'Login']); ?>
        <?= $form->field($model, 'password', ['template' => "<div class='form-group has-feedback'>{input}<span class=\"glyphicon glyphicon-lock form-control-feedback\"></span><div>{error}</div></div>"])->passwordInput(['placeholder' => 'Password']); ?>

        <div class="row">
            <div class="col-xs-8">
                <div class="checkbox icheck">
                    <?= $form->field($model, 'rememberMe')->checkbox(['template' => "{label} {input}"]); ?>

                </div>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
                <?= Html::submitButton('Login', ['class' => 'btn btn-info btn-block btn-flat', 'name' => 'login-button']); ?>

            </div>
            <!-- /.col -->
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>






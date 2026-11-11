<?php

/** @var yii\web\View $this */
/** @var app\models\Subscribe|null $model */
/** @var bool $done */

use app\models\Subscribe;
use yii\helpers\Html;

$this->title = 'Отписка от рассылки';
?>
<div class="container" style="padding: 60px 15px; text-align: center;">
    <h2><?= Html::encode($this->title) ?></h2>

    <?php if (!$model): ?>
        <p>Ссылка для отписки недействительна или устарела.</p>

    <?php elseif ($done || (int)$model->active === Subscribe::STATUS_INACTIVE): ?>
        <p>Адрес <strong><?= Html::encode($model->email) ?></strong> отписан от рассылки.</p>
        <p>Если передумаете — подпишитесь снова через форму внизу страницы.</p>

    <?php else: ?>
        <p>Вы действительно хотите отписать <strong><?= Html::encode($model->email) ?></strong> от рассылки?</p>
        <?= Html::beginForm(['/site/unsubscribe', 'token' => $model->token], 'post') ?>
            <?= Html::submitButton('Отписаться', ['class' => 'btn btn-danger']) ?>
        <?= Html::endForm() ?>
    <?php endif; ?>

    <p style="margin-top: 30px;"><?= Html::a('Вернуться в магазин', ['/']) ?></p>
</div>

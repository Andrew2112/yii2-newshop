<?php

use app\models\Subscribe;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Subscribe */

$this->title = $model->email;
$this->params['breadcrumbs'][] = ['label' => 'Подписчики', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$isActive = (int)$model->active === Subscribe::STATUS_ACTIVE;
?>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a($isActive ? 'Отписать' : 'Подписать снова', ['toggle', 'id' => $model->id], [
                    'class' => 'btn btn-warning',
                    'data' => ['method' => 'post'],
                ]) ?>
                <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Удалить подписчика? Если нужно только прекратить рассылку — используйте «Отписать».',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
            <div class="subscribe-view">

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'email:email',
                        [
                            'attribute' => 'active',
                            'value' => $isActive
                                ? '<span class="text-green">Подписан</span>'
                                : '<span class="text-red">Отписан</span>',
                            'format' => 'raw',
                        ],
                        [
                            'attribute' => 'created_at',
                            'format' => ['datetime', 'php: d M Y H:i:s'],
                        ],
                        [
                            'attribute' => 'unsubscribed_at',
                            'format' => ['datetime', 'php: d M Y H:i:s'],
                        ],
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>

<?php

use app\models\Subscribe;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\SubscribeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список подписчиков';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <?= Html::a('Добавить подписчика', ['create'], ['class' => 'btn btn-success']) ?>
            </div>

            <div class="box-body">
                <div class="subscribe-index">

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'id',
                            'email:email',
                            [
                                'attribute' => 'active',
                                'filter' => Subscribe::statusList(),
                                'value' => function (Subscribe $data) {
                                    return (int)$data->active === Subscribe::STATUS_ACTIVE
                                        ? '<span class="text-green">Подписан</span>'
                                        : '<span class="text-red">Отписан</span>';
                                },
                                'format' => 'raw',
                            ],
                            [
                                'attribute' => 'created_at',
                                'format' => ['datetime', 'php: d M Y H:i'],
                                'filter' => false,
                            ],
                            [
                                'attribute' => 'unsubscribed_at',
                                'format' => ['datetime', 'php: d M Y H:i'],
                                'filter' => false,
                            ],

                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => 'Действие',
                                'template' => '{toggle} {view} {update} {delete}',
                                'buttons' => [
                                    'toggle' => function ($url, Subscribe $model) {
                                        $isActive = (int)$model->active === Subscribe::STATUS_ACTIVE;
                                        return Html::a(
                                            '<span class="glyphicon glyphicon-' . ($isActive ? 'pause' : 'play') . '"></span>',
                                            $url,
                                            [
                                                'title' => $isActive ? 'Отписать' : 'Подписать снова',
                                                'data' => ['method' => 'post'],
                                            ]
                                        );
                                    },
                                ],
                            ],
                        ],
                    ]); ?>

                </div>
            </div>
        </div>
    </div>
</div>

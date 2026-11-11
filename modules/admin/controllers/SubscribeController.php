<?php

namespace app\modules\admin\controllers;

use app\models\Subscribe;
use app\modules\admin\models\SubscribeSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\web\NotFoundHttpException;

/**
 * Подписчики на рассылку: список, просмотр, добавление, редактирование, удаление,
 * быстрое включение/отключение подписки.
 */
class SubscribeController extends AppAdminController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                    'toggle' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new SubscribeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Ручное добавление подписчика. Письмо подписчику при этом не отправляется.
     */
    public function actionCreate()
    {
        $model = new Subscribe();
        $model->active = Subscribe::STATUS_ACTIVE;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Подписчик добавлен');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Изменения сохранены');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Включить/отключить подписку без удаления записи.
     */
    public function actionToggle($id)
    {
        $model = $this->findModel($id);
        $model->active = (int)$model->active === Subscribe::STATUS_ACTIVE
            ? Subscribe::STATUS_INACTIVE
            : Subscribe::STATUS_ACTIVE;
        $model->save(false, ['active', 'unsubscribed_at']);

        $email = Html::encode($model->email);
        Yii::$app->session->setFlash('success', (int)$model->active === Subscribe::STATUS_ACTIVE
            ? "Подписка {$email} включена"
            : "Подписка {$email} отключена");

        return $this->redirect(Yii::$app->request->referrer ?: ['index']);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('error', 'Подписчик удалён');
        return $this->redirect(['index']);
    }

    /**
     * @return Subscribe
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = Subscribe::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Подписчик не найден.');
    }
}

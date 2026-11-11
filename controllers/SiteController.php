<?php

namespace app\controllers;

use app\modules\admin\models\Product;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Subscribe;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'subscribe' => ['post'],
                    'unsubscribe' => ['get', 'post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionTest(){
       /* $products=Product::find()->all();
        foreach ($products as $product){
            $product->visible=1;
            $product->save();
        }*/
    }

    /**
     * Подписка на рассылку (AJAX из формы в футере).
     * Ранее отписавшийся e-mail подписывается снова (active = 1).
     */
    public function actionSubscribe()
    {
        $model = Subscribe::subscribe(Yii::$app->request->post('email'));

        if ($model->hasErrors()) {
            return $this->asJson([
                'success' => false,
                'message' => $model->getFirstError('email') ?: 'Не удалось оформить подписку. Попробуйте позже.',
            ]);
        }

        $sent = Yii::$app->notifier->sendSubscribed($model);

        return $this->asJson([
            'success' => true,
            'message' => $sent
                ? 'Спасибо, что подписались! На вашу почту отправлено уведомление.'
                : 'Спасибо, что подписались!',
        ]);
    }

    /**
     * Отписка по ссылке из письма.
     * GET — страница с кнопкой подтверждения (почтовые антивирусы открывают ссылки из писем
     * и иначе отписывали бы людей сами), POST — собственно отписка.
     * Запись из БД не удаляется, а помечается active = 0.
     */
    public function actionUnsubscribe($token = null)
    {
        $model = $token ? Subscribe::findOne(['token' => (string)$token]) : null;
        $done = false;

        if ($model && Yii::$app->request->isPost) {
            $done = $model->unsubscribe();
        }

        return $this->render('unsubscribe', [
            'model' => $model,
            'done' => $done,
        ]);
    }
}

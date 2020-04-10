<?php


namespace app\controllers;


use app\models\Product;

class HotoffersController extends AppController
{
    public function actionOffers()
    {
        $gift=Product::find()->where(['gift'=>1])->limit(8)->all();
        return $this->render('offers', compact('gift'));
    }
}
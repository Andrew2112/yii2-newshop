<?php


namespace app\controllers;


use app\models\Product;

class HotoffersController extends AppController
{
    public function actionOffers()
    {
        $offer=Product::find()->where(['is_offer'=>1])->limit(4)->all();
        return $this->render('offers', compact('offer'));
    }
}
<?php


namespace app\controllers;


use app\models\Product;
use app\models\RelatedProduct;
use yii\web\NotFoundHttpException;

class ProductController extends AppController
{
    public function actionView($id)
    {
        $product = Product::findOne($id);
        $related = $product->items;
        //debug($related);die();
        if (empty($product)) {
            throw new NotFoundHttpException('Такого продукта нет...');
        }
        $this->setMeta("{$product->title}::" . \Yii::$app->name, $product->keywords, $product->description);
        return $this->render('view', compact('product','related'));
    }
}
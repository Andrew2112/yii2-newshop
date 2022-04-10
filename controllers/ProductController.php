<?php


namespace app\controllers;


use app\models\Product;
use app\models\RelatedProduct;
use app\models\Reviews;
use Yii;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;

class ProductController extends AppController
{
    public function actionView($id)
    {
        //$product = Product::findOne($id);
        $product = Product::find()->andWhere(['visible'=>1])->andWhere(['=', 'id', $id])->one();
        $related = $product->items;

        if (empty($product)) {
            throw new NotFoundHttpException('Такого продукта нет...');
        }
        $reviews = Reviews::find()->where('product_id' == $id)->all();
        $qty = $product->getProduct()->count();

        if ($qty){
            $rating = round($product->getProduct()->sum('rating') / $qty, 1);
        }

        $query = Reviews::find()->where(['product_id' => $id])->orderBy(['id' => SORT_DESC]);
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 3, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $reviews = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        $model=new Reviews;
        $model->product_id = Yii::$app->getRequest()->get('id');
        if ($model->load(\Yii::$app->request->post()) && $model->save()) {

            if (\Yii::$app->request->isPjax) {

                \Yii::$app->session->setFlash('success', 'Спасибо за комментарий');

                $model = new Reviews;
            } else {
                \Yii::$app->session->setFlash('success', 'Данные приняты');
                return $this->refresh();

            }

            return $this->refresh();
        }




        $this->setMeta("{$product->title}::" . \Yii::$app->name, $product->keywords, $product->description);
        return $this->render('view', compact('product','related', 'model', 'qty', 'pages', 'rating', 'reviews'));
    }
}
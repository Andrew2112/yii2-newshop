<?php

namespace app\controllers;

use app\models\Category;
use app\models\CategoryProduct;
use app\models\Product;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
use yii\web\Request;

class CategoryController extends AppController
{
    public function actionView($alias)
    {
        $category = Category::find()->where(['visible' => 1, 'alias' => $alias])->one();

        if (empty($category)) {
            throw new NotFoundHttpException('Категория не найдена');
        }

        $this->setMeta("{$category->title}::" . \Yii::$app->name, $category->keywords, $category->description);

        // Используем id из найденной категории
        $category_product = CategoryProduct::find()->where(['category_id' => $category->id])->all();

        $query = Product::find()->where(['category_id' => $category->id, 'visible' => 1]);
        $pages = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => 4,
            'forcePageParam' => false,
            'pageSizeParam' => false
        ]);
        $products = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('view', compact('category', 'category_product', 'products', 'pages'));
    }


    public function actionSearch()
    {
        $q = trim(\Yii::$app->request->get('q'));
        $this->setMeta("Поиск: {$q}::" . \Yii::$app->name);
        if (!$q) {
            return $this->render('search');
        }
        $query = Product::find()->where(['like', 'title', $q]);
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 2, 'forcePageParam'=>false, 'pageSizeParam'=>false]);
        $products = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $this->render('search', compact('products', 'pages', 'q'));
    }

}
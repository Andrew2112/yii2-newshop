<?php

namespace app\commands;

use app\modules\admin\models\Category;
use app\modules\admin\models\Product;
use yii\console\Controller;
use yii\helpers\Inflector;

class CategoryController extends Controller
{
    /**
     * Генерация alias из title для всех категорий без alias.
     */
    public function actionGenerateAlias()
    {
        $categories = Category::find()->where(['alias' => ''])->all();

        if (empty($categories)) {
            echo "Нет категорий без alias.\n";
            return;
        }

        foreach ($categories as $category) {
            $alias = Inflector::slug($category->title);
            $originalAlias = $alias;
            $suffix = 1;

            // Проверка на уникальность alias
            while (Category::find()->where(['alias' => $alias])->andWhere(['<>', 'id', $category->id])->exists()) {
                $alias = $originalAlias . '-' . $suffix++;
            }

            $category->alias = $alias;

            if ($category->save(false)) {
                echo "✅ {$category->title} => {$category->alias}\n";
            } else {
                echo "❌ Ошибка при сохранении категории ID: {$category->id}\n";
            }
        }

        echo "🎉 Генерация alias завершена.\n";
    }
    public function actionProductAlias()
    {
        $products = Product::find()->where(['alias' => ''])->all();

        if (empty($products)) {
            echo "Нет продуктов без alias.\n";
            return;
        }

        foreach ($products as $product) {
            $alias = Inflector::slug($product->title);
            $originalAlias = $alias;
            $suffix = 1;

            // Проверка на уникальность alias
            while (Category::find()->where(['alias' => $alias])->andWhere(['<>', 'id', $product->id])->exists()) {
                $alias = $originalAlias . '-' . $suffix++;
            }

            $product->alias = $alias;

            if ($product->save(false)) {
                echo "✅ {$product->title} => {$product->alias}\n";
            } else {
                echo "❌ Ошибка при сохранении категории ID: {$product->id}\n";
            }
        }

        echo "🎉 Генерация alias завершена.\n";
    }
}

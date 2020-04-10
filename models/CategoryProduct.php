<?php


namespace app\models;


use yii\db\ActiveRecord;

class CategoryProduct extends ActiveRecord
{
    public static function tableName()
    {
        return 'category_product';
    }
    public function getSub()
    {
        return $this->hasMany(Product::class, ['category_product_id'=>'id']);
    }
    public function getUpcategory()
    {
        return $this->hasOne(Category::class, ['id'=>'category_id']);
    }
}
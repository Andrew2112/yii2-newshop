<?php


namespace app\models;


use yii\db\ActiveRecord;

class Product extends ActiveRecord
{

    public static function tableName()
    {
        return 'product';
    }

   /* public function getCategory()
    {
        return $this->hasMany(Product::class, ['id' => 'category_id']);
    }*/
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    public function getRelated()
    {
        return $this->hasMany(RelatedProduct::class, ['product_id' => 'id']);

    }
    public function getItems()
    {
        return $this->hasMany(Product::class, ['id' => 'related_id'])
            ->via('related');

    }
    public function getProduct()
    {
        return $this->hasMany(Reviews::class, [ 'product_id'=>'id'] );
    }

}
<?php

namespace app\models;

use yii\db\ActiveRecord;

class Category extends ActiveRecord
{
    public static function tableName()
    {
        return 'category';
    }

    public function getCat()
    {
        return $this->hasMany(CategoryProduct::class, ['category_id' => 'id']);
    }
}
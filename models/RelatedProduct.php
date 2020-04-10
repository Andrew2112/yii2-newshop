<?php


namespace app\models;


use yii\db\ActiveRecord;

class RelatedProduct extends ActiveRecord
{
    public static function tableName()
    {
        return 'related_product';
    }


}
<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "reviews".
 *
 * @property int $id
 * @property int $product_id
 * @property string $username
 * @property string $email
 * @property string $post
 * @property string $created_at
 * @property float $rating
 */
class Reviews extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reviews';
    }
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['created_at'],
                ],
                // если вместо метки времени UNIX используется datetime:
                'value' => new Expression('NOW()'),
            ],

        ];
    }
    public function getReview()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'username', 'email', 'post',  'rating'], 'required'],
            [['product_id'], 'integer'],
            [['post'], 'string'],
            [['created_at'], 'safe'],
            [['rating'], 'safe'],
            [['username'], 'string', 'max' => 255],
            [['email'], 'email'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'username' => 'Имя',
            'email' => 'E-mail',
            'post' => 'Отзыв',

            'rating' => 'Оценка',
        ];
    }
}

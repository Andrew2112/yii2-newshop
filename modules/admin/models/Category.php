<?php

namespace app\modules\admin\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property int $parent_id
 * @property string $title
 * @property string|null $description
 * @property string|null $keywords
 * @property string $img
 */
class Category extends \yii\db\ActiveRecord
{
    public $file;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id'=>'parent_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id'], 'integer'],
            [['title', 'img'], 'required'],
            [['title', 'description', 'keywords', 'img'], 'string', 'max' => 255],
            [['file'], 'image'],
            [['visible'], 'safe'],
            [['img'], 'default', 'value' => 'images/no-image.png'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Родительская категория',
            'title' => 'Наименование',
            'description' => 'Описание',
            'keywords' => 'Ключевые слова',
            'file'=>'Фото категории',
            'img' => 'Фото категории',
            'visible'=>'Показывать'
        ];
    }
    public function beforeSave($insert)
    {
        if ($file = UploadedFile::getInstance($this, 'file')) {
            $dir = 'images/' . date("Y-m-d") . '/';
            if (!is_dir($dir)) {
                mkdir($dir);
            }
            $file_name = uniqid() . '_' . $file->baseName . '.' . $file->extension;
            $this->img = $dir . $file_name;
            $file->saveAs($this->img);
        }
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

}

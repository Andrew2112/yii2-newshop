<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subscribe".
 *
 * @property int $id
 * @property string $email
 * @property int $active 1 — подписан, 0 — отписался
 * @property string|null $token токен для ссылки отписки
 * @property string|null $created_at
 * @property string|null $unsubscribed_at
 */
class Subscribe extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subscribe';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email'], 'trim'],
            [['email'], 'required'],
            [['email'], 'email'],
            [['email'], 'string', 'max' => 255],
            [['email'], 'unique', 'message' => 'Этот e-mail уже подписан на рассылку.'],
            [['active'], 'default', 'value' => self::STATUS_ACTIVE],
            [['active'], 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        if ($insert && empty($this->created_at)) {
            $this->created_at = date('Y-m-d H:i:s');
        }
        if (empty($this->token)) {
            $this->token = Yii::$app->security->generateRandomString(32);
        }
        // Дата отписки следует за статусом (в т.ч. при смене статуса из админки)
        if ($insert || $this->isAttributeChanged('active', false)) {
            $this->unsubscribed_at = (int)$this->active === self::STATUS_INACTIVE
                ? ($this->unsubscribed_at ?: date('Y-m-d H:i:s'))
                : null;
        }
        return true;
    }

    /**
     * Варианты статуса для фильтров и выпадающих списков.
     */
    public static function statusList(): array
    {
        return [
            self::STATUS_ACTIVE => 'Подписан',
            self::STATUS_INACTIVE => 'Отписан',
        ];
    }

    /**
     * Оформляет подписку на e-mail: создаёт новую запись или включает обратно ранее отписавшегося.
     * Возвращает модель; если подписка не оформлена — в ней будут ошибки валидации.
     */
    public static function subscribe($email): self
    {
        $email = trim((string)$email);
        $model = static::find()->where(['email' => $email])->one() ?: new static();

        if (!$model->isNewRecord && (int)$model->active === self::STATUS_ACTIVE) {
            $model->addError('email', 'Этот e-mail уже подписан на рассылку.');
            return $model;
        }

        $model->email = $email;
        $model->active = self::STATUS_ACTIVE;
        $model->save();

        return $model;
    }

    /**
     * Отписка: запись не удаляется, только помечается неактивной.
     */
    public function unsubscribe(): bool
    {
        if ((int)$this->active === self::STATUS_INACTIVE) {
            return true;
        }
        $this->active = self::STATUS_INACTIVE;
        return $this->save(false, ['active', 'unsubscribed_at']);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'active' => 'Активна',
            'token' => 'Токен',
            'created_at' => 'Дата подписки',
            'unsubscribed_at' => 'Дата отписки',
        ];
    }

    /**
     * {@inheritdoc}
     * @return SubscribeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SubscribeQuery(get_called_class());
    }
}

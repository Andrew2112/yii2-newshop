<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Subscribe]].
 *
 * @see Subscribe
 */
class SubscribeQuery extends \yii\db\ActiveQuery
{
    /**
     * Только активные подписчики (для рассылки).
     */
    public function active()
    {
        return $this->andWhere(['active' => Subscribe::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     * @return Subscribe[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Subscribe|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

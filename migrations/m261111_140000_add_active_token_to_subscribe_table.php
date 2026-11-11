<?php

use yii\db\Migration;
use yii\db\Query;

/**
 * Добавляет в `{{%subscribe}}` флаг активности подписки и токен для ссылки отписки,
 * а также уникальный индекс по email.
 */
class m261111_140000_add_active_token_to_subscribe_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%subscribe}}', 'active', $this->tinyInteger(1)->notNull()->defaultValue(1)->after('email'));
        $this->addColumn('{{%subscribe}}', 'token', $this->string(64)->null()->after('active'));
        $this->addColumn('{{%subscribe}}', 'unsubscribed_at', $this->dateTime()->null()->after('created_at'));

        // Токены для уже существующих подписчиков
        $ids = (new Query())->select('id')->from('{{%subscribe}}')->column($this->db);
        foreach ($ids as $id) {
            $this->update('{{%subscribe}}', ['token' => Yii::$app->security->generateRandomString(32)], ['id' => $id]);
        }

        $this->createIndex('idx-subscribe-email', '{{%subscribe}}', 'email', true);
        $this->createIndex('idx-subscribe-token', '{{%subscribe}}', 'token', true);
    }

    public function safeDown()
    {
        $this->dropIndex('idx-subscribe-token', '{{%subscribe}}');
        $this->dropIndex('idx-subscribe-email', '{{%subscribe}}');
        $this->dropColumn('{{%subscribe}}', 'unsubscribed_at');
        $this->dropColumn('{{%subscribe}}', 'token');
        $this->dropColumn('{{%subscribe}}', 'active');
    }
}

<?php

use yii\db\Migration;

class m170301_124015_subscription_system_fk extends Migration
{
    public function safeUp()
    {
        $this->createIndex(
            'idx-subscription-system-subscription',
            '{{%subscription_system}}',
            'id_subscription',
            false);
        $this->addForeignKey(
            "fk_subscription-system-subscription",
            "{{%subscription_system}}",
            "id_subscription",
            "{{%subscription}}",
            "id",
            'CASCADE');

        $this->createIndex(
            'idx-subscription-system-user',
            '{{%subscription_system}}',
            'id_user',
            false);
        $this->addForeignKey(
            "fk_subscription-system-user",
            "{{%subscription_system}}",
            "id_user",
            "{{%user}}",
            "id",
            'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey(
            'fk_subscription-system-subscription',
            'subscription_system'
        );
        $this->dropIndex(
            'idx-subscription-system-subscription',
            'subscription_system'
        );
        $this->dropForeignKey(
            'fk_subscription-system-user',
            'subscription_system'
        );
        $this->dropIndex(
            'idx-subscription-system-user',
            'subscription_system'
        );
    }
}

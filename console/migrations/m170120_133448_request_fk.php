<?php

use yii\db\Migration;

class m170120_133448_request_fk extends Migration
{


    public function safeUp()
    {
        $this->createIndex(
            'idx-standard_user_account-request',
            '{{%request}}',
            'id_standard_user_account',
            false);
        $this->addForeignKey(
            "fk_standard_user_account-request",
            "{{%request}}",
            "id_standard_user_account",
            "{{standard_user_account}}",
            "id",
            'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey(
            'fk_standard_user_account-request',
            'request'
        );
        $this->dropIndex(
            'idx-standard_user_account-request',
            'request'
        );
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}

<?php

use yii\db\Migration;

class m170127_103906_business_user_account_fk extends Migration
{
    public function up()
    {
        $this->createIndex(
            'idx-user-business_user_account',
            '{{%business_user_account}}',
            'id_user',
            true);
        $this->addForeignKey(
            "fk_business_user_account",
            "{{%business_user_account}}",
            "id_user",
            "{{%user}}",
            "id",
            'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey(
            'fk_business_user_account',
            'business_user_account'
        );
        $this->dropIndex(
            'idx-user-business_user_account',
            'business_user_account'
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

<?php

use yii\db\Migration;

class m170116_083936_standard_user_account_fk extends Migration
{
    public function up()
    {
        $this->createIndex(
            'idx-user-standard_user_account',
            '{{%standard_user_account}}',
            'id_user',
            true);
        $this->addForeignKey(
            "fk_standard_user_account",
            "{{%standard_user_account}}",
            "id_user",
            "{{%user}}",
            "id",
            'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey(
            'fk_standard_user_account',
            'standard_user_account'
        );
        $this->dropIndex(
            'idx-user-standard_user_account',
            'standard_user_account'
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

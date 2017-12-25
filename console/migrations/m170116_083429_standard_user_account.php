<?php

use yii\db\Migration;

class m170116_083429_standard_user_account extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%standard_user_account}}', [
            'id' => $this->primaryKey(),
            'id_user' => $this->integer()->notNull(),
            'verification_email' => $this->boolean()->notNull()->defaultValue(0),
            'phone' => $this->integer()->unique(),
            'verification_phone' => $this->boolean()->notNull()->defaultValue(0),
            'id_gender' => $this->smallInteger()->notNull()->defaultValue(0),
            'notice_system' => $this->boolean()->notNull()->defaultValue(0),
            'notice_general' => $this->boolean()->notNull()->defaultValue(0),
            'first_name' => $this->char(255)->notNull(),
            'last_name' => $this->char(255)->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%standard_user_account}}');
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

<?php

use yii\db\Migration;

class m170628_140552_target_devotion extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%target_devotion}}', [
            'id' => $this->primaryKey(),
            'id_request' => $this->integer()->notNull(),
            'id_object' => $this->integer()->notNull(),
            'id_business_account' => $this->integer()->notNull(),
            'status' => $this->smallInteger()->defaultValue(0),
            'prise' => $this->money()->notNull(),
            'expiration_date' => $this->integer()->notNull(),
            'id_method_payment' => $this->integer()->notNull(),
            'clogging' => $this->smallInteger()->notNull(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%target_devotion}}');
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

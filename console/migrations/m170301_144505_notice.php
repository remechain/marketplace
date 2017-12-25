<?php

use yii\db\Migration;

class m170301_144505_notice extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%notice}}', [
            'id' => $this->primaryKey(),
            'name' => $this->char(255)->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%notice}}');
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

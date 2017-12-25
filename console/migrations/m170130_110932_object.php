<?php

use yii\db\Migration;

class m170130_110932_object extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%object}}', [
            'id' => $this->primaryKey(),
            'id_company' => $this->integer()->notNull(),
            'name' => $this->string()->notNull()->unique(),
            'email' => $this->string(),
            'phone' => $this->integer(),
            'id_city' => $this->integer(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'id_status' => $this->integer()->notNull()->defaultValue(1),
            'id_type_object' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%object}}');
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

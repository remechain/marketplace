<?php

use yii\db\Migration;

class m170522_105932_create_object_address extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%object_address}}', [
            'id' => $this->primaryKey(),
            'address' => $this->char(255),
            'id_city' => $this->bigInteger(),
            'cor1' => $this->double(6),
            'cor2' => $this->double(6),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%object_address}}');
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

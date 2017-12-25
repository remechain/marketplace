<?php

use yii\db\Migration;

class m170707_123314_object_address_ymap extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%object_address_ymap}}', [
            'id' => $this->primaryKey(),
            'country' => $this->char(6)->defaultValue('Россия'),
            'region' => $this->char(255),
            'province' => $this->char(255),
            'area' => $this->char(255),
            'locality' => $this->char(255),
            'street' => $this->char(255),
            'house' => $this->char(255),
            'id_object' => $this->integer()->notNull(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%object_address_ymap}}');
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

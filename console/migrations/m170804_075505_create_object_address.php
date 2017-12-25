<?php

use yii\db\Migration;

class m170804_075505_create_object_address extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->dropTable('{{%object_address}}');

        $this->createTable('{{%object_address}}', [
            'id_object' => $this->primaryKey(),
            'country' => $this->char(255),
            'region' => $this->char(255),
            'province' => $this->char(255),
            'area' => $this->char(255),
            'locality' => $this->char(255),
            'street' => $this->char(255),
            'house' => $this->char(255),
        ], $tableOptions);

        $this->createIndex(
            'idx-object_gost-object_address',
            '{{%object_address}}',
            'id_object',
            false);
        $this->addForeignKey(
            "fk-object_object_address",
            "{{%object_address}}",
            "id_object",
            "{{object}}",
            "id",
            'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('{{%object_address}}');
    }
}

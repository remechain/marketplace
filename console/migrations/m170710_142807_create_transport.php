<?php

use yii\db\Migration;

class m170710_142807_create_transport extends Migration
{
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%transport}}', [
            'id' => $this->primaryKey(),
            'name' => $this->char(255),
        ], $tableOptions);

        $this->batchInsert('{{transport}}', ['name'],
            [
                ['Грузовик 10 т'],
                ['Грузовик 15 т'],
                ['Грузовик 30 т'],
            ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%transport}}');
    }
}

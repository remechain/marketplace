<?php

use yii\db\Migration;

class m170410_093322_test_sity extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%test_sity}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
        ], $tableOptions);

        $this->batchInsert('{{%test_sity}}', ['name'],
            [
                ['Москва'],
                ['Череповец'],
                ['Вологда'],
            ]);
    }

    public function  safeDown()
    {
        $this->dropTable('{{%test_sity}}');
    }
}

<?php

use yii\db\Migration;

class m170130_093747_type_object extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%type_object}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'active' => $this ->boolean()->defaultValue(0),
        ], $tableOptions);

        $this->batchInsert('{{%type_object}}', ['name'],
            [
                ['Завод'],
                ['Площадка'],
                ['Трейдер'],
            ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%type_object}}');
    }
}

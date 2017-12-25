<?php

use yii\db\Migration;

class m170124_091101_method_payment extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%method_payment}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
        ], $tableOptions);

        $this->batchInsert('{{%method_payment}}', ['name'],
            [
                ['Наличные'],
                ['Безнал'],
            ]);
    }

    public function safeDown()
    {
        $this->delete('{{%method_payment}}', ['in', 'name', [
            'Наличные',
            'Безнал',
        ]]);
        $this->dropTable('{{%method_payment}}');
    }
}

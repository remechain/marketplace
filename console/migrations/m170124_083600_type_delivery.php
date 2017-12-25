<?php

use yii\db\Migration;

class m170124_083600_type_delivery extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%type_delivery}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
        ], $tableOptions);

        $this->batchInsert('{{%type_delivery}}', ['name'],
            [
                ['Забрать по адресу'],
                ['Привезу самостоятельно'],
            ]);
    }

    public function safeDown()
    {
        $this->delete('{{%type_delivery}}', ['in', 'name', [
            'Забрать по адресу',
            'Привезу самостоятельно',
        ]]);
        $this->dropTable('{{%type_delivery}}');
    }
}

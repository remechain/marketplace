<?php

use yii\db\Migration;

class m170130_080827_type_company extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%type_company}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'active' => $this ->boolean()->defaultValue(0),
        ], $tableOptions);

        $this->batchInsert('{{%type_company}}', ['name'],
            [
                ['ОАО'],
                ['ЗАО'],
            ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%type_company}}');
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

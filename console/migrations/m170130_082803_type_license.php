<?php

use yii\db\Migration;

class m170130_082803_type_license extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%type_license}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'active' => $this ->boolean()->defaultValue(0),
        ], $tableOptions);

        $this->batchInsert('{{%type_license}}', ['name'],
            [
                ['Временная'],
                ['Постоянная'],
            ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%type_license}}');
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

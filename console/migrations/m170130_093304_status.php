<?php

use yii\db\Migration;

class m170130_093304_status extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%status}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'active' => $this ->boolean()->defaultValue(0),
        ], $tableOptions);

        $this->batchInsert('{{%status}}', ['name'],
            [
                ['Ждет модерацию'],
                ['Заблокированна'],
                ['Активная'],
            ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%status}}');
    }
}

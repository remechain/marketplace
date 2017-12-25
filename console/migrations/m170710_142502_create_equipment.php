<?php

use yii\db\Migration;

class m170710_142502_create_equipment extends Migration
{
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%equipment}}', [
            'id' => $this->primaryKey(),
            'name' => $this->char(255),
        ], $tableOptions);

        $this->batchInsert('{{equipment}}', ['name'],
            [
                ['Спектральный анализатор металлов'],
                ['Эксалатор-грейфер'],
                ['Авто весы'],
            ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%equipment}}');
    }
}

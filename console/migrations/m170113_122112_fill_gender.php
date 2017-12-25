<?php

use yii\db\Migration;

class m170113_122112_fill_gender extends Migration
{
    public function up()
    {
        $this->batchInsert('{{%gender}}', ['name'],
            [
                ['женский'],
                ['мужской'],
            ]);
    }

    public function down()
    {
        $this->delete('{{%gender}}', ['in', 'name', [
            'женский',
            'мужской',
        ]]);
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

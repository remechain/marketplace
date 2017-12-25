<?php

use yii\db\Migration;

class m170301_150833_subscription_fill extends Migration
{
    public function up()
    {
        $this->batchInsert('{{%subscription}}', ['name'],
            [
                ['Новости о металоломе'],
                ['Цены на металолом в Тагонроге'],
            ]);
    }

    public function down()
    {

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

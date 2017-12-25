<?php

use yii\db\Migration;

class m170301_150759_notice_fill extends Migration
{
    public function up()
    {
        $this->batchInsert('{{%notice}}', ['name'],
            [
                ['Общеинформационная рассылка'],
                ['Системные уведомления'],
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

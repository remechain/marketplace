<?php

use yii\db\Migration;

class m170802_110017_fk_day extends Migration
{
    public function up()
    {
        $this->batchInsert('{{%day}}', ['name'],
            [
                ['Понедельник'],
                ['Вторник'],
                ['Среда'],
                ['Четверг'],
                ['Пятница'],
                ['Суббота'],
                ['Воскресенье'],
            ]);
    }

    public function down()
    {

    }

}

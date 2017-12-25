<?php

use yii\db\Migration;

class m170125_123152_type_scrap_gost_fill extends Migration
{
    public function safeUp()
    {
        $this->batchInsert('{{%type_scrap_gost}}', ['name'],
            [
                ['Черный лом'],
                ['Цветной лом'],
                ['Технический и электронный лом'],
            ]);
    }

    public function safeDown()
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

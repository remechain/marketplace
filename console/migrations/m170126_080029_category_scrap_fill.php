<?php

use yii\db\Migration;

class m170126_080029_category_scrap_fill extends Migration
{
    public function safeUp()
    {
        $this->batchInsert('{{%category_scrap}}', ['name','id_type_scrap_gost'],
            [
                ['Черный лом','1'],
                ['Нержавеющий лом','1'],
                ['Алюминий','2'],
                ['Медь, латунь, бронза','2'],
                ['Прочий цветной лом','2'],
                ['Аккумуляторы','3'],
                ['Бытовая техника','3'],
                ['Электомоторы, радиаторы, генераторы','3'],
                ['Электронный лом','3'],
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

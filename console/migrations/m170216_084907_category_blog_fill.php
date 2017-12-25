<?php

use yii\db\Migration;

class m170216_084907_category_blog_fill extends Migration
{
    public function up()
    {
        $this->batchInsert('{{%category_blog}}', ['name'],
            [
                ['Технологии'],
                ['Металлы'],
                ['Материалы'],
                ['Процессы'],
            ]);
    }

    public function down()
    {

    }
}

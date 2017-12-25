<?php

use yii\db\Migration;

class m170526_093534_enumerator_blog_fill extends Migration
{
    public function up()
    {
        $this->batchInsert('{{%enumerator_blog}}',
            ['id_category_blog', 'count'],
            [
                [1,0],
                [2,0],
                [3,0],
                [4,0],
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

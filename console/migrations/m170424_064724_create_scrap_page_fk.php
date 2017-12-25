<?php

use yii\db\Migration;

class m170424_064724_create_scrap_page_fk extends Migration
{
    public function up()
    {

        $this->createIndex(
            'idx-category-scrap-gost-scrap-page',
            '{{%scrap_page}}',
            'id_category_scrap_gost',
            false);
        $this->addForeignKey(
            "fk_category-scrap-gost-scrap-page",
            "{{%scrap_page}}",
            "id_category_scrap_gost",
            "{{%category_scrap_gost}}",
            "id",
            'CASCADE');
    }

    public function down()
    {

    }
}

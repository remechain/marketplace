<?php

use yii\db\Migration;

class m170126_074850_category_scrap_gost_fk extends Migration
{
    public function safeUp()
    {
        $this->createIndex(
            'idx-category-scrap-gost-type_scrap_gost',
            '{{%category_scrap_gost}}',
            'id_type_scrap_gost',
            false);
        $this->addForeignKey(
            "fk_category_scrap_gost",
            "{{%category_scrap_gost}}",
            "id_type_scrap_gost",
            "{{%type_scrap_gost}}",
            "id",
            'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey(
            'fk_category_scrap_gost',
            'category_scrap_gost'
        );
        $this->dropIndex(
            'idx-category-scrap-gost-type_scrap_gost',
            'category_scrap_gost'
        );
    }
}

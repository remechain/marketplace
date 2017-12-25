<?php

use yii\db\Migration;

class m170125_151340_category_scrap_fk extends Migration
{
    public function safeUp()
    {
        $this->createIndex(
            'idx-category-scrap-type-scrap-gost',
            '{{%category_scrap}}',
            'id_type_scrap_gost',
            false);
        $this->addForeignKey(
            "fk_category_scrap",
            "{{%category_scrap}}",
            "id_type_scrap_gost",
            "{{%type_scrap_gost}}",
            "id",
            'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey(
            'fk_category_scrap',
            'category_scrap'
        );
        $this->dropIndex(
            'idx-category-scrap-type-scrap-gost',
            'category_scrap'
        );
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

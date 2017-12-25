<?php

use yii\db\Migration;

class m170131_091047_object_fk extends Migration
{
    public function safeUp()
    {
        $this->createIndex(
            'idx-object-company',
            '{{%object}}',
            'id_company',
            false);
        $this->addForeignKey(
            "fk_object-company",
            "{{%object}}",
            "id_company",
            "{{%company}}",
            "id",
            'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey(
            'fk_object-company',
            'object'
        );
        $this->dropIndex(
            'idx-object-company',
            'object'
        );
    }
}

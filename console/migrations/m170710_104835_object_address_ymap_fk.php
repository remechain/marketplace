<?php

use yii\db\Migration;

class m170710_104835_object_address_ymap_fk extends Migration
{


    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $this->createIndex(
            'idx-object_address_ymap-object',
            '{{%object_address_ymap}}',
            'id_object',
            false);
        $this->addForeignKey(
            "fk_object_address_ymap-object",
            "{{%object_address_ymap}}",
            "id_object",
            "{{object}}",
            "id",
            'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey(
            'fk_object_address_ymap-object',
            'object_address_ymap'
        );
        $this->dropIndex(
            'idx-object_address_ymap-object',
            'object_address_ymap'
        );
    }

}

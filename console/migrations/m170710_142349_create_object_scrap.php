<?php

use yii\db\Migration;

class m170710_142349_create_object_scrap extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%object_scrap}}', [
            'id_object' => $this->integer()->notNull(),
            'id_type_scrap_gost' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'idx-object_scrap-object',
            '{{%object_scrap}}',
            'id_object',
            false);
        $this->addForeignKey(
            "fk_object_scrap-object",
            "{{%object_scrap}}",
            "id_object",
            "{{object}}",
            "id",
            'CASCADE');

        $this->createIndex(
            'idx-object_scrap-type_scrap_gost',
            '{{%object_scrap}}',
            'id_type_scrap_gost',
            false);
        $this->addForeignKey(
            "fk_object_scrap-type_scrap_gost",
            "{{%object_scrap}}",
            "id_type_scrap_gost",
            "{{type_scrap_gost}}",
            "id",
            'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('{{%object_scrap}}');
    }
}

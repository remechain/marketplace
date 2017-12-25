<?php

use yii\db\Migration;

class m170710_142940_create_object_transport extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%object_transport}}', [
            'id_object' => $this->integer()->notNull(),
            'id_transport' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'idx-object-object_transport',
            '{{%object_transport}}',
            'id_object',
            false);
        $this->addForeignKey(
            "fk_object-object_transport",
            "{{%object_transport}}",
            "id_object",
            "{{object}}",
            "id",
            'CASCADE');

        $this->createIndex(
            'idx-object_scrap-object_transport',
            '{{%object_transport}}',
            'id_transport',
            false);
        $this->addForeignKey(
            "fk_object_scrap-object_transport",
            "{{%object_transport}}",
            "id_transport",
            "{{%transport}}",
            "id",
            'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('{{%object_equipment}}');
    }
}

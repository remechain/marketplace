<?php

use yii\db\Migration;

class m170710_142607_create_object_equipment extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%object_equipment}}', [
            'id_object' => $this->integer()->notNull(),
            'id_equipment' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'idx-object-object_equipment',
            '{{%object_equipment}}',
            'id_object',
            false);
        $this->addForeignKey(
            "fk_object-object_equipment",
            "{{%object_equipment}}",
            "id_object",
            "{{object}}",
            "id",
            'CASCADE');

        $this->createIndex(
            'idx-object_scrap-object_equipment',
            '{{%object_equipment}}',
            'id_equipment',
            false);
        $this->addForeignKey(
            "fk_object_scrap-object_equipment",
            "{{%object_equipment}}",
            "id_equipment",
            "{{%equipment}}",
            "id",
            'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('{{%object_equipment}}');
    }
}

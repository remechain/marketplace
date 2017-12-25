<?php

use yii\db\Migration;

class m170725_125612_create_object_accept_scrap extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%object_accept_scrap}}', [
            'id_object' => $this->integer()->notNull(),
            'id_accept_scrap' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'idx-object-accept_scrap',
            '{{%object_accept_scrap}}',
            'id_object',
            false);
        $this->addForeignKey(
            "fk_object-object_accept_scrap",
            "{{%object_accept_scrap}}",
            "id_object",
            "{{object}}",
            "id",
            'CASCADE');

        $this->createIndex(
            'idx-object_object_accept_scrap',
            '{{%object_accept_scrap}}',
            'id_accept_scrap',
            false);
        $this->addForeignKey(
            "fk_accept_scrap-object_accept_scrap",
            "{{%object_accept_scrap}}",
            "id_accept_scrap",
            "{{%accept_scrap}}",
            "id",
            'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('{{%object_equipment}}');
    }
}

<?php

use yii\db\Migration;

class m170801_144217_create_schedule extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%schedule}}', [
            'id_object' => $this->integer()->notNull(),
            'id_day' => $this->integer()->notNull(),
            'time_begin' => $this->time(),
            'time_end' => $this->time(),
        ], $tableOptions);

        $this->createIndex(
            'idx-object-schedule',
            '{{%schedule}}',
            'id_object',
            false);
        $this->addForeignKey(
            "fk_object-schedule",
            "{{%schedule}}",
            "id_object",
            "{{object}}",
            "id",
            'CASCADE');

        $this->createIndex(
            'idx-day_schedule',
            '{{%schedule}}',
            'id_day',
            false);
        $this->addForeignKey(
            "fk_day-schedule",
            "{{%schedule}}",
            "id_day",
            "{{%day}}",
            "id",
            'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('{{%schedule}}');
    }
}

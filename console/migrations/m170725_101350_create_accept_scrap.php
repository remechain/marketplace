<?php

use yii\db\Migration;

class m170725_101350_create_accept_scrap extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%accept_scrap}}', [
            'id' => $this->primaryKey(),
            'prise' => $this->money(),
            'clogging' => $this->smallInteger(),
            'min_weight' => $this->float(3),
            'id_category_scrap_gost' => $this->integer(),
        ], $tableOptions);

        $this->createIndex(
            'idx-category_scrap_gost-accept_scrap',
            '{{%accept_scrap}}',
            'id_category_scrap_gost',
            false);
        $this->addForeignKey(
            "fk-category_scrap_gost-accept_scrap",
            "{{%accept_scrap}}",
            "id_category_scrap_gost",
            "{{category_scrap_gost}}",
            "id",
            'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('{{%accept_scrap}}');
    }
}

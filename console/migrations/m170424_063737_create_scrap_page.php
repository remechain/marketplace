<?php

use yii\db\Migration;

class m170424_063737_create_scrap_page extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%scrap_page}}', [
            'id' => $this->primaryKey(),
            'preview_img' => $this->char(255),
            'title' => $this->char(255)->notNull(),
            'content' =>$this->text()->notNull(),
            'id_category_scrap_gost' => $this->integer()->notNull(),

            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%scrap_page}}');
    }

}

<?php

use yii\db\Migration;

class m170216_082351_blog_pages extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%blog_pages}}', [
            'id' => $this->primaryKey(),
            'preview_img' => $this->char(255)->notNull(),
            'title' => $this->char(255)->notNull(),
            'content' =>$this->text()->notNull(),
            'id_category_blog' => $this->integer()->notNull(),
            'active' => $this->boolean()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%blog_pages}}');
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

<?php

use yii\db\Migration;

class m170216_084858_category_blog_fk extends Migration
{
    public function safeUp()
    {
        $this->createIndex(
            'idx-blog_pages-category_blog',
            '{{%blog_pages}}',
            'id_category_blog',
            false);
        $this->addForeignKey(
            "fk_blog_pages-category_blog",
            "{{%blog_pages}}",
            "id_category_blog",
            "{{%category_blog}}",
            "id",
            'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey(
            'fk_blog_pages-category_blog',
            'blog_pages'
        );
        $this->dropIndex(
            'idx-blog_pages-category_blog',
            'blog_pages'
        );
    }
}

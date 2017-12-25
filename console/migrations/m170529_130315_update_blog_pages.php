<?php

use yii\db\Migration;

class m170529_130315_update_blog_pages extends Migration
{
    public function up()
    {
        $this->addColumn('blog_pages', 'lid_text', $this->char(255)->notNull());
    }

    public function down()
    {
        $this->dropColumn('blog_pages','lid_text');
    }

}

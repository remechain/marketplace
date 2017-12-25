<?php

use yii\db\Migration;

class m170609_113653_update_object extends Migration
{
    public function up()
    {
        $this->addColumn('object','site','char(255)');
    }

    public function down()
    {
       $this->dropColumn('object','site');
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

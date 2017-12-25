<?php

use yii\db\Migration;

class m170612_123621_update_company extends Migration
{
    public function up()
    {
        $this->alterColumn('company', 'id_status', $this->integer()->defaultValue(1));
    }

    public function down()
    {
        $this->alterColumn('company', 'id_status', $this->integer()->defaultValue(0));
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

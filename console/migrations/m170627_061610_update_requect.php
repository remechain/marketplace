<?php

use yii\db\Migration;

class m170627_061610_update_requect extends Migration
{
    public function up()
    {
        $this->addColumn('request', 'id_shopper', $this->integer()->defaultValue(0));
    }

    public function down()
    {
        $this->dropColumn('request','id_shopper');
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

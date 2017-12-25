<?php

use yii\db\Migration;

class m170504_081831_update_business_user_account extends Migration
{
    public function up()
    {
        $this->alterColumn('business_user_account', 'landline_phone', $this->char(50)->unique());
        $this->alterColumn('business_user_account', 'phone', $this->bigInteger()->unique());
        $this->dropColumn('business_user_account','company_name');
    }

    public function down()
    {
        $this->alterColumn('business_user_account', 'landline_phone', $this->integer());
        $this->alterColumn('business_user_account', 'phone', $this->Integer());
        $this->addColumn('business_user_account','company_name', $this->char(100));
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

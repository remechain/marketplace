<?php

use yii\db\Migration;

class m170623_074200_update_request extends Migration
{
    public function up()
    {
        $this->addColumn('request', 'status', $this->smallInteger()->defaultValue(0));
    }

    public function down()
    {
        $this->dropColumn('request','status');
    }

}

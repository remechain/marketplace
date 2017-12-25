<?php

use yii\db\Migration;

class m170130_094133_company extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%company}}', [
            'id' => $this->primaryKey(),
            'name' => $this->char(40)->notNull(),
            'inn' => $this->bigInteger(12)->notNull(),
            'id_type_company' => $this->integer()->notNull(),
            'id_type_license' => $this->integer()->notNull(),
            'id_status' => $this->integer()->notNull()->defaultValue(0),
            'count_factory' => $this->integer()->defaultValue(0),
            'count_platform' => $this->integer()->defaultValue(0),

            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),

            'id_business_user_account' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%company}}');
    }
}

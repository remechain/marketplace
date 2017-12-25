<?php

use yii\db\Migration;

class m170120_132809_request extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%request}}', [
            'id' => $this->primaryKey(),
            'id_standard_user_account' => $this->integer()->notNull(),
            'id_type_delivery' => $this->integer()->notNull(),
            'id_city' => $this->integer()->notNull(),
            'address' => $this->string()->notNull(),
            'id_category_scrap' => $this->integer()->notNull()->defaultValue(1),
            'id_category_scrap_gost' => $this->integer()->notNull()->defaultValue(1),
            'id_type_scrap_gost' => $this->integer()->notNull()->defaultValue(1),
            'id_method_payment' => $this->integer()->notNull()->defaultValue(0),
            'desired_price' => $this->float()->notNull(),
            'dismantling' => $this->boolean()->notNull()->defaultValue(0),
            'mass' => $this->float()->notNull(),
            'category_by_gost' => $this->boolean()->notNull()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%request}}');
    }
}

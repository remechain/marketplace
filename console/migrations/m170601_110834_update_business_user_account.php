<?php

use yii\db\Migration;

class m170601_110834_update_business_user_account extends Migration
{

    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $this->dropForeignKey(
            'fk_company-business_user_account',
            'company'
        );
        $this->dropIndex(
            'idx-company-business_user_account',
            'company'
        );

        $this->renameColumn('business_user_account','id_business_user_account','id');


        $this->createIndex(
            'idx-company-business_user_account',
            '{{%company}}',
            'id_business_user_account',
            false);
        $this->addForeignKey(
            "fk_company-business_user_account",
            "{{%company}}",
            "id_business_user_account",
            "{{%business_user_account}}",
            "id",
            'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey(
            'fk_company-business_user_account',
            'company'
        );
        $this->dropIndex(
            'idx-company-business_user_account',
            'company'
        );

        $this->renameColumn('business_user_account','id','id_business_user_account');

        $this->createIndex(
            'idx-company-business_user_account',
            '{{%company}}',
            'id_business_user_account',
            false);
        $this->addForeignKey(
            "fk_company-business_user_account",
            "{{%company}}",
            "id_business_user_account",
            "{{%business_user_account}}",
            "id_business_user_account",
            'CASCADE');
    }

}

<?php

use yii\db\Migration;

class m170131_074744_company_fk extends Migration
{
    public function safeUp()
    {
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
    }
}

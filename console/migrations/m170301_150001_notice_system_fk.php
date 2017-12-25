<?php

use yii\db\Migration;

class m170301_150001_notice_system_fk extends Migration
{
    public function safeUp()
    {
        $this->createIndex(
            'idx-notice-system-notice',
            '{{%notice_system}}',
            'id_notice',
            false);
        $this->addForeignKey(
            "fk_notice-system-notice",
            "{{%notice_system}}",
            "id_notice",
            "{{%notice}}",
            "id",
            'CASCADE');

        $this->createIndex(
            'idx-notice-system-user',
            '{{%notice_system}}',
            'id_user',
            false);
        $this->addForeignKey(
            "fk_notice-system-user",
            "{{%notice_system}}",
            "id_user",
            "{{%user}}",
            "id",
            'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey(
            'fk_notice-system-notice',
            'notice_system'
        );
        $this->dropIndex(
            'idx-notice-system-notice',
            'notice_system'
        );
        $this->dropForeignKey(
            'fk_notice-system-user',
            'notice_system'
        );
        $this->dropIndex(
            'idx-notice-system-user',
            'notice_system'
        );
    }
}

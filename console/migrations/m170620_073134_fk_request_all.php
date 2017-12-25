<?php

use yii\db\Migration;

class m170620_073134_fk_request_all extends Migration
{


    public function safeUp()
    {
        $this->createIndex(
            'idx-type_delivery-request',
            '{{%request}}',
            'id_type_delivery',
            false);
        $this->addForeignKey(
            "fk_type_delivery-request",
            "{{%request}}",
            "id_type_delivery",
            "{{type_delivery}}",
            "id",
            'CASCADE');

        $this->createIndex(
            'idx-category_scrap-request',
            '{{%request}}',
            'id_category_scrap',
            false);
        $this->addForeignKey(
            "fk_category_scrap-request",
            "{{%request}}",
            "id_category_scrap",
            "{{category_scrap}}",
            "id",
            'CASCADE');

        $this->createIndex(
            'idx-category_scrap_gost-request',
            '{{%request}}',
            'id_category_scrap_gost',
            false);
        $this->addForeignKey(
            "fk_category_scrap_gost-request",
            "{{%request}}",
            "id_category_scrap_gost",
            "{{category_scrap_gost}}",
            "id",
            'CASCADE');

        $this->createIndex(
            'idx-type_scrap_gost-request',
            '{{%request}}',
            'id_type_scrap_gost',
            false);
        $this->addForeignKey(
            "fk_type_scrap_gost-request",
            "{{%request}}",
            "id_type_scrap_gost",
            "{{type_scrap_gost}}",
            "id",
            'CASCADE');

        $this->createIndex(
            'idx-method_payment-request',
            '{{%request}}',
            'id_method_payment',
            false);
        $this->addForeignKey(
            "fk_method_payment-request",
            "{{%request}}",
            "id_method_payment",
            "{{method_payment}}",
            "id",
            'CASCADE');
    }


    public function safeDown()
    {
        $this->dropForeignKey(
            'fk_type_delivery-request',
            'request'
        );
        $this->dropIndex(
            'idx-type_delivery-request',
            'request'
        );

        $this->dropForeignKey(
            'fk_category_scrap-request',
            'request'
        );
        $this->dropIndex(
            'idx-category_scrap-request',
            'request'
        );

        $this->dropForeignKey(
            'fk_category_scrap_gost-request',
            'request'
        );
        $this->dropIndex(
            'idx-category_scrap_gost-request',
            'request'
        );

        $this->dropForeignKey(
            'fk_type_scrap_gost-request',
            'request'
        );
        $this->dropIndex(
            'idx-type_scrap_gost-request',
            'request'
        );

        $this->dropForeignKey(
            'fk_method_payment-request',
            'request'
        );
        $this->dropIndex(
            'idx-method_payment-request',
            'request'
        );

    }
}
<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "target_devotion".
 *
 * @property integer $id
 * @property integer $id_request
 * @property integer $id_object
 * @property integer $id_business_account
 * @property integer $status
 * @property string $prise
 * @property integer $expiration_date
 * @property integer $id_method_payment
 * @property integer $clogging
 */
class TargetDevotion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'target_devotion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_request', 'id_object', 'prise', 'expiration_date', 'id_method_payment', 'clogging'], 'required'],
            [['id_request', 'id_object', 'id_business_account', 'status', 'expiration_date', 'id_method_payment', 'clogging'], 'integer'],
            [['prise'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_request' => 'Id Request',
            'id_object' => 'Id Object',
            'id_business_account' => 'Id Business Account',
            'status' => 'Status',
            'prise' => 'Prise',
            'expiration_date' => 'Expiration Date',
            'id_method_payment' => 'Id Method Payment',
            'clogging' => 'Clogging',
        ];
    }
}

<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "method_payment".
 *
 * @property integer $id_method_payment
 * @property string $name
 */
class MethodPayment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'method_payment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_method_payment' => 'Id Method Payment',
            'name' => 'Name',
        ];
    }
}

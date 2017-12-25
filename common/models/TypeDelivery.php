<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "type_delivery".
 *
 * @property integer $id_type_delivery
 * @property string $name
 */
class TypeDelivery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'type_delivery';
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
            'id_type_delivery' => 'Id Type Delivery',
            'name' => 'Name',
        ];
    }
}

<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "object_address".
 *
 * @property integer $id
 * @property string $address
 * @property string $id_city
 * @property double $cor1
 * @property double $cor2
 */
class ObjectAddress extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'object_address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_city'], 'integer'],
            [['cor1', 'cor2'], 'number'],
            [['address'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'address' => 'Address',
            'id_city' => 'Id City',
            'cor1' => 'Cor1',
            'cor2' => 'Cor2',
        ];
    }
}

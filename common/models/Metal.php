<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "metal".
 *
 * @property integer $id_metal
 * @property integer $id_request
 * @property integer $id_category_scrap
 * @property integer $category_scrap_gost
 * @property integer $id_type_scrap_gost
 * @property integer $id_method_payment
 * @property double $desired_price
 * @property integer $dismantling
 * @property double $mass
 */
class Metal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'metal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_request', 'desired_price', 'mass', 'category_by_gost'], 'required'],
            [['id_request', 'id_category_scrap', 'category_scrap_gost', 'id_type_scrap_gost', 'id_method_payment', 'dismantling'], 'integer'],
            [['desired_price', 'mass'], 'number'],
            [['category_by_gost'],'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_metal' => 'Id Metal',
            'id_request' => 'Id Request',
            'id_category_scrap' => 'Id Category Scrap',
            'category_scrap_gost' => 'Category Scrap Gost',
            'id_type_scrap_gost' => 'Id Type Scrap Gost',
            'id_method_payment' => 'Id Method Payment',
            'desired_price' => 'Desired Price',
            'dismantling' => 'Dismantling',
            'mass' => 'Mass',
            'category_by_gost' => 'Указать категорию по гост'
        ];
    }


    /**
     * @return array Массив с записями из таблицы MethodPayment
     */
    public function getMethodPaymentMap(){
        $list = MethodPayment::find()->all();
        $result = ArrayHelper::map($list,'id','name');
        return $result;
    }

}

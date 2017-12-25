<?php

namespace common\models\dynamicform;

use common\models\TestSity;
use common\models\TypeDelivery;
use frontend\models\StandardUserAccount;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "request".
 *
 * @property integer $id
 * @property integer $id_standard_user_account
 * @property integer $id_type_delivery
 * @property integer $id_city
 * @property string $address
 * @property StandardUserAccount $idStandardUserAccount
 */
class RequestParent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'request';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_type_delivery', 'id_city', 'address'], 'required'],
            [['id_standard_user_account', 'id_type_delivery', 'id_city'], 'integer'],
            [['address'], 'string', 'max' => 255],
            [['id_standard_user_account'], 'exist', 'skipOnError' => true, 'targetClass' => StandardUserAccount::className(), 'targetAttribute' => ['id_standard_user_account' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Id Request',
            'id_standard_user_account' => 'Id Standard User Account',
            'id_type_delivery' => 'Тип доставки',
            'id_city' => 'Город',
            'address' => 'Адрес',
            'created_at' => 'Дата создания',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdStandardUserAccount()
    {
        return $this->hasOne(StandardUserAccount::className(), ['id' => 'id_standard_user_account']);
    }

    /**
     * @return array Массив с записями из таблицы TypeDelivery
     */
    public function getTypeDeliveryMap(){
        $list = TypeDelivery::find()->all();
        $result = ArrayHelper::map($list,'id','name');
        return $result;
    }

    public function getIdCurentStandardUserAccount(){
        $result = StandardUserAccount::find()->where(['id_user' => Yii::$app->user->id ])->one();
        return  $result->id;
    }

    //todo временная тадлица бд для городов незобыть подчистить
    /**
     * @return array Массив с записями из таблицы Test_sity
     */
    public function getSityMap(){
        $list = TestSity::find()->all();
        $result = ArrayHelper::map($list,'id','name');
        return $result;
    }
}

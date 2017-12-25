<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "company".
 *
 * @property integer $id
 * @property string $name
 * @property string $inn
 * @property integer $id_type_company
 * @property integer $id_type_license
 * @property integer $id_status
 * @property integer $count_factory
 * @property integer $count_platform
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $id_business_user_account
 *
 * @property BusinessUserAccount $idBusinessUserAccount
 * @property Object[] $objects
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'inn', 'id_type_company', 'id_type_license', 'id_business_user_account'], 'required'],
            [['inn', 'id_type_company', 'id_type_license', 'id_status', 'count_factory', 'count_platform', 'created_at', 'updated_at', 'id_business_user_account'], 'integer'],
            [['name'], 'string', 'max' => 40],
            [['id_business_user_account'], 'exist', 'skipOnError' => true, 'targetClass' => BusinessUserAccount::className(), 'targetAttribute' => ['id_business_user_account' => 'id_business_user_account']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'inn' => 'Inn',
            'id_type_company' => 'Id Type Company',
            'id_type_license' => 'Id Type License',
            'id_status' => 'Id Status',
            'count_factory' => 'Count Factory',
            'count_platform' => 'Count Platform',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'id_business_user_account' => 'Id Business User Account',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdBusinessUserAccount()
    {
        return $this->hasOne(BusinessUserAccount::className(), ['id_business_user_account' => 'id_business_user_account']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjects()
    {
        return $this->hasMany(Object::className(), ['id_company' => 'id']);
    }


    /**
     * @return int
     */
    public static function getCurrentIdBusinessUserAccount(){
        /** @var BusinessUserAccount $currentIdBusinessUserAccount */
        $currentIdBusinessUserAccount = BusinessUserAccount::find()->where(['id_user' => Yii::$app->user->id])->one();
        return $currentIdBusinessUserAccount->id_business_user_account;
    }

    /**
     * @return array
     */
    public static function getTypeCompanyMap(){
        $list = TypeCompany::find()->all();
        $result = ArrayHelper::map($list,'id','name');
        return $result;
    }

    /**
     * @return array
     */
    public static function getTypeLicenseMap(){
        $list = TypeLicense::find()->all();
        $result = ArrayHelper::map($list,'id','name');
        return $result;
    }


    public function getIdTypeCompany()
    {
        return $this->hasOne(TypeCompany::className(), ['id' => 'id_type_company']);
    }

    public function getIdTypeLicense()
    {
        return $this->hasOne(TypeLicense::className(), ['id' => 'id_type_license']);
    }

    public function getIdStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'id_status']);
    }

    /**
     * @return array
     */
    public static function getStatusMap(){
        $list = Status::find()->all();
        $result = ArrayHelper::map($list,'id','name');
        return $result;
    }

    //todo нужно доделать не удобно так выбирать
    /**
     * @return array
     */
    public function getBusinessUserAccountMap(){
        $list = BusinessUserAccount::find()->all();
        $result = ArrayHelper::map($list,'id_business_user_account','id_business_user_account');
        return $result;
    }
}
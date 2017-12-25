<?php

namespace frontend\models;

use common\models\Status;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "company".
 *
 * @property integer $id
 * @property integer $id_business_user_account
 * @property string $name
 * @property integer $inn
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $id_type_company
 * @property integer $id_status
 * @property integer $id_type_license
 * @property integer $count_factory
 * @property integer $count_platform
 *
 * @property BusinessUserAccount $idBusinessUserAccount
 */
class Company extends \common\models\Company
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%company}}';
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
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'inn', 'id_type_company', 'id_type_license'], 'required'],
            [['id_business_user_account', 'inn', 'created_at', 'updated_at', 'id_type_company','id_type_license'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['inn'], 'unique'],
            [['id_business_user_account'], 'exist', 'skipOnError' => true, 'targetClass' => BusinessUserAccount::className(), 'targetAttribute' => ['id_business_user_account' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Название компании',
            'inn' => 'ИНН',
            'id_type_company' => 'Тип компании',
            'id_type_license' => 'Тип лицензии',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdBusinessUserAccount()
    {
        return $this->hasOne(BusinessUserAccount::className(), ['id' => 'id_business_user_account']);
    }

    /**
     * @return int
     */
    public static function getCurrentIdBusinessUserAccount(){
        /** @var BusinessUserAccount $currentIdBusinessUserAccount */
        $currentIdBusinessUserAccount = BusinessUserAccount::find()->where(['id_user' => Yii::$app->user->id])->one();
        return $currentIdBusinessUserAccount->id;
    }

    /**
     * @return
     */
    public static function getCurrentCompanies(){
        /** @var BusinessUserAccount $currentIdBusinessUserAccount */
        $currentCompanies = Company::find()->where(['id_business_user_account' => Company::getCurrentIdBusinessUserAccount()])->all();
        return $currentCompanies;
    }

    public static function getCheckCurrentCompany($id){
        $companies = Company::getCurrentCompanies();
        foreach ($companies as $company){
            if($company->id == $id){
                return true;
            }
        }
        return false;
    }


    /**
     * @return Status
     */
    public function getStatus(){
        $result = Status::find()->where(['id' => $this->id_status])->one() ;

        return $result;
    }
}

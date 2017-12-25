<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "business_user_account".
 *
 * @property integer $id_business_user_account
 * @property integer $id_user
 * @property integer $verification_email
 * @property integer $phone
 * @property integer $verification_phone
 * @property integer $id_gender
 * @property integer $notice_system
 * @property integer $notice_general
 * @property string $first_name
 * @property string $last_name
 * @property integer $landline_phone
 * @property string $company_name
 *
 * @property User $idUser
 */
class BusinessUserAccount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'business_user_account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user', 'first_name', 'last_name', 'company_name'], 'required'],
            [['id_user', 'verification_email', 'phone', 'verification_phone', 'id_gender', 'notice_system', 'notice_general', 'landline_phone'], 'integer'],
            [['first_name', 'last_name', 'company_name'], 'string', 'max' => 255],
            [['id_user'], 'unique'],
            [['phone'], 'unique'],
            [['landline_phone'], 'unique'],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_business_user_account' => 'Id Business User Account',
            'id_user' => 'Id User',
            'verification_email' => 'Verification Email',
            'phone' => 'Phone',
            'verification_phone' => 'Verification Phone',
            'id_gender' => 'Id Gender',
            'notice_system' => 'Notice System',
            'notice_general' => 'Notice General',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'landline_phone' => 'Landline Phone',
            'company_name' => 'Company Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }

    /**
     * @return array
     */
    public function getGender(){
        $gender = Gender::find()->all();
        $result = ArrayHelper::map($gender,'id_gender','name');
        return $result;
    }
}

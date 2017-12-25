<?php

namespace frontend\models;


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
 *
 * @property User $idUser
 */
class BusinessUserAccount extends \common\models\BusinessUserAccount
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
            [['id_user', 'first_name', 'last_name'], 'required'],
            [['id_user', 'verification_email', 'verification_phone', 'id_gender', 'notice_system', 'notice_general'], 'integer'],
            [['first_name', 'last_name'], 'string', 'max' => 255],
            [['id_user'], 'unique'],
            [['landline_phone','phone'],'string'],
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

            'phone' => 'Мобильный телефон',
            /*'verification_phone' => 'Verification Phone',*/
            'id_gender' => 'Пол',
            'notice_system' => 'Системные уведомления',
            'notice_general' => 'Общеинформационная рассылка',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',

           /* 'id_business_user_account' => 'Id Business User Account',*/
            'id_user' => 'Id User',
            'verification_email' => 'Verification Email',

            'verification_phone' => 'Verification Phone',
            'landline_phone' => 'Стационарный телефон',
            'company_name' => 'Название компании',
        ];
    }
}

<?php
namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * Signup form
 */
class SignupBusinessForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $phone;
    public $first_name;
    public $last_name;
    public $landline_phone;
    public $company_name;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            /*['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],*/

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\frontend\models\User', 'message' => 'Это адрес электронной почты уже зарегистрирован.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6, 'tooShort'=>'Пароль не меньше 6'],

            ['phone', 'required'],
            ['phone', 'string', 'min' => 10, 'tooShort'=>'Телефон введен не до конца'],
            ['phone', 'unique', 'targetClass' => '\common\models\StandardUserAccount', 'message' => 'Этот телефон уже зарегестрирован.'],
            ['phone', 'unique', 'targetClass' => '\common\models\BusinessUserAccount', 'message' => 'Этот телефон уже зарегестрирован.'],

            ['landline_phone', 'required'],
            ['landline_phone', 'string', 'max' => 50],
            ['landline_phone', 'unique', 'targetClass' => '\common\models\BusinessUserAccount', 'message' => 'Этот телефон уже зарегестрирован.'],


            ['company_name', 'required'],
            ['company_name', 'string', 'max' => 255],
            /*['company_name', 'unique', 'targetClass' => '\common\models\BusinessUserAccount', 'message' => 'Название компании уже занято'],*/


            ['first_name', 'required'],
            ['first_name', 'string', 'max' => 255],

            ['last_name', 'required'],
            ['last_name', 'string', 'max' => 255],


        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => 'Email',
            'verification_email' => 'Verification Email',
            'phone' => 'Номер телефона',
            'verification_phone' => 'Verification Phone',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'password' => 'Пароль',

            'landline_phone' => 'Стационарный телефон',
            'company_name' => 'Название компании',
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
           var_dump( $this->errors);
            return null;
        }

        $user = new User();
        //todo исправить username является email
        $user->username = $this->email;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        /*if (!$user->validate()) {
            return null;
        }*/

        $transaction = Yii::$app->db->beginTransaction();
        if($user->save()){
            $businessUserAccount = new BusinessUserAccount();
            $businessUserAccount->id_user = $user->id;
            $businessUserAccount->phone = $this->phone;
            $businessUserAccount->first_name = $this->first_name;
            $businessUserAccount->last_name =  $this->last_name;
            //$businessUserAccount->company_name =  $this->company_name;
            $businessUserAccount->landline_phone =  $this->landline_phone;
            //die(var_dump($user->errors));
            if($businessUserAccount->save()){
                $transaction->commit();
                return $user;
            }else{
                $transaction->rollback();
                return null;
            }
        }else{
            $transaction->rollback();
            return null;
        }



    }
}

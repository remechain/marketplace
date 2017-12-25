<?php
namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * Signup form
 */
class SignupStandartForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $phone;
    public $first_name;
    public $last_name;

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
            $standardUserAccount = new StandardUserAccount();
            $standardUserAccount->id_user = $user->id;
            $standardUserAccount->phone = $this->phone;
            $standardUserAccount->first_name = $this->first_name;
            $standardUserAccount->last_name =  $this->last_name;
            //die(var_dump($user->errors));
            if($standardUserAccount->save()){
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

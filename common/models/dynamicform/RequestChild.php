<?php

namespace common\models\dynamicform;

use frontend\models\StandardUserAccount;
use Yii;

/**
 * This is the model class for table "request".
 *
 * @property integer $id_category_scrap
 * @property integer $id_category_scrap_gost
 * @property integer $id_type_scrap_gost
 * @property integer $id_method_payment
 * @property double $desired_price
 * @property integer $dismantling
 * @property double $mass
 * @property integer $category_by_gost
 * @property integer $created_at
 * @property integer $updated_ats
 *
 * @property StandardUserAccount $idStandardUserAccount
 */
class RequestChild extends \common\models\Request
{

    public $units;

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
            [['desired_price', 'mass'], 'required'],
            [['desired_price', 'mass'], 'required'],
            [['id_category_scrap', 'id_category_scrap_gost', 'id_type_scrap_gost', 'id_method_payment', 'dismantling', 'category_by_gost', 'created_at', 'updated_at'], 'integer'],
            [['desired_price', 'mass'], 'number'],
            [['units'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_category_scrap' => 'Категория металла',
            'id_category_scrap_gost' => 'Категория металла по ГОСТ',
            'id_type_scrap_gost' => 'Вид металла по ГОСТ',
            'id_method_payment' => 'Способ оплаты',
            'desired_price' => 'Желаемая цена',
            'dismantling' => 'Требуется демонтаж',
            'mass' => 'Масса',
            'category_by_gost' => 'Указать категорию по ГОСТ',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdStandardUserAccount()
    {
        return $this->hasOne(StandardUserAccount::className(), ['id_standard_user_account' => 'id_standard_user_account']);
    }

    public function getIdCurentStandardUserAccount(){
        $result = StandardUserAccount::find()->where(['id_user' => Yii::$app->user->id ])->one();
        return  $result->id;
    }

}

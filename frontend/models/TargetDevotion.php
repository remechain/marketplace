<?php

namespace frontend\models;

use common\models\MethodPayment;
use yii\db\Query;
use yii\helpers\ArrayHelper;


/**
 * This is the model class for table "target_devotion".
 *
 * @property integer $id
 * @property integer $id_request
 * @property integer $id_object
 * @property integer $id_business_account
 * @property integer $status
 * @property string $prise
 * @property integer $expiration_date
 * @property integer $id_method_payment
 * @property integer $clogging
 * @property Company $company
 */

class TargetDevotion extends \common\models\TargetDevotion
{
    /**
     * @return array Массив с записями из таблицы MethodPayment
     */
    public function getMethodPaymentMap(){
        $list = MethodPayment::find()->all();
        $result = ArrayHelper::map($list,'id','name');
        return $result;
    }
    public function getMyObjectMap(){
        $objects = (new Query())->
        select(['object.id','object.name'])->
        from('company')->
        where(['id_business_user_account' => Company::getCurrentIdBusinessUserAccount()])->
        join('INNER JOIN','object','company.id = object.id_company')->all();

        $result = ArrayHelper::map($objects,'id','name');
        return $result;
    }


}

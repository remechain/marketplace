<?php

namespace frontend\controllers;

use common\models\AcceptScrap;
use common\models\Day;
use common\models\Equipment;
use common\models\ObjectAcceptScrap;
use common\models\ObjectAddress;
use common\models\ObjectAddressYmap;
use common\models\ObjectEquipment;
use common\models\ObjectScrap;
use common\models\ObjectTransport;
use common\models\Schedule;
use common\models\Transport;
use common\models\TypeScrapGost;
use frontend\models\Company;
use frontend\models\Object;
use Yii;
use yii\base\Model;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;

class ObjectController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }


    public function actionCreate()
    {
        $model = new Object();
        $address = new ObjectAddress();
        //$address->load(Yii::$app->request->post());
        $equipments = Equipment::getAllEquipments();
        $transports = Transport::getAllTransports();
        $scraps = TypeScrapGost::getAllTypeScrapGost();
        $weekends = Day::getWeekendMap();
        $weekdays = Day::getWeekdayMap();
        $scheduleWeekday = new Schedule();
        $scheduleWeekend = new Schedule();

        if ($model->load(Yii::$app->request->post()) ) {

            if (Company::getCheckCurrentCompany($model->id_company)) {

                $transaction = Yii::$app->db->beginTransaction();

                if ($model->save()) {
                    $address->load(Yii::$app->request->post());
                    $address->id_object = $model->id;

                    //обработка списка принемаемых металлов
                    //$acceptScrapModel = new AcceptScrap();
                    $acceptScrapModels = [new AcceptScrap()];
                    //die(var_dump(Yii::$app->request->post('Object', [])));
                    $data = Yii::$app->request->post('Object', []);
                    $dateMultiple['AcceptScrap'] = [];

                    foreach (array_keys($data['schedule']) as $index) {
                        $acceptScrapModels[$index] = new AcceptScrap();
                        $dateMultiple['AcceptScrap'][$index] = $data['schedule'][$index];
                    }

                    Model::loadMultiple($acceptScrapModels, $dateMultiple);

                    /* @var $objectComment AcceptScrap*/
                    foreach ($acceptScrapModels as $acceptScrap){
                        if(!$acceptScrap->save()){
                            die(var_dump($acceptScrap->error()));
                            //todo обработать ситуацию когда не сохранился список принимаемых металлов
                        }else{
                            $objectAcceptScrap = new ObjectAcceptScrap();
                            $objectAcceptScrap->id_accept_scrap = $acceptScrap->id;
                            $objectAcceptScrap->id_object = $model->id;
                            $objectAcceptScrap->save();
                        }
                    }
                    //---обработка списка принемаемых металлов

                    if ($address->save()) {
                        // return $this->redirect(Url::toRoute(['company/view', 'id' => $model->id_company]));
                        if (ObjectEquipment::setObjectEquipments($model->equipments, $model->id)) {
                            if (ObjectTransport::setObjectTransports($model->transports, $model->id)) {
                                if (ObjectScrap::setObjectScraps($model->scraps, $model->id)) {
                                    if ($scheduleWeekday->load(Yii::$app->request->post())&& $scheduleWeekend->load(Yii::$app->request->post())) {
                                        if (Schedule::setWeekdays($model->weekday, $model->id,
                                            $scheduleWeekday->time_begin,
                                            $scheduleWeekday->time_end)
                                        &&
                                            Schedule::setWeekend($model->weekend, $model->id,
                                                $scheduleWeekend->time_begin,
                                                $scheduleWeekend->time_end)
                                        ) {
                                            $transaction->commit();
                                            return $this->redirect(['index']);
                                        }
                                    }
                                }
                            }
                        }
                    }
                };
                $transaction->rollBack();
            }
        }



        return $this->render('create', [
            'model' => $model,
            'equipments' => $equipments,
            'transports' => $transports,
            'scraps' => $scraps,
            'weekdays' => $weekdays,
            'weekends' => $weekends,
            'address' => $address,
            'scheduleWeekday' => $scheduleWeekday,
            'scheduleWeekend' => $scheduleWeekend,
        ]);
    }

    public function actionCreateFirst()
    {
        $model = new Object();

        if($model->id_company === Company::getCurrentIdBusinessUserAccount()){
            if($model->save()){
               // return $this->redirect(Url::toRoute(['company/object','companyId' => $model->id_company]));
            return '';
            };
        }
        return $this->render('create',[
            'model' => $model,
        ]);
    }


    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $equipments = Equipment::getAllEquipments();

        if ($model->load(Yii::$app->request->post()) ) {

            if (Company::getCheckCurrentCompany($model->id_company)) {

                $transaction = Yii::$app->db->beginTransaction();

                if ($model->save()) {
                    $address = new ObjectAddressYmap();
                    $address->region = '';
                    $address->province = '';
                    $address->area = '';
                    $address->locality = '';
                    $address->street = '';
                    $address->house = '';
                    $address->id_object = $model->id;
                    if ($address->save()) {
                            if (ObjectEquipment::setObjectEquipments($model->equipments, $model->id)) {
                                $transaction->commit();
                                return $this->redirect(['index']);
                            }
                    }
                };
                $transaction->rollBack();
            }
        }
        return $this->render('create', [
            'model' => $model,
            'equipments' => $equipments,
        ]);
    }

    /**
     * Finds the Object model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Object the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Object::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

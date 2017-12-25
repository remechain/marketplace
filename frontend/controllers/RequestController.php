<?php

namespace frontend\controllers;


use common\models\CategoryScrapGost;
use common\models\dynamicform\Model ;
use common\models\dynamicform\RequestChild;
use common\models\dynamicform\RequestParent;
use frontend\models\Request;
use frontend\models\RequestSearch;
use Yii;
use yii\console\Exception;
use yii\base\Controller;
use yii\filters\VerbFilter;

/**
 * RequestController реализует создание запросов для standard_user_account и создание металлов в запросе.
 * @property RequestChild $Metal
 */
class RequestController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Creates a new Customer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $modelParent = new RequestParent;
        $modelChild = [new RequestChild];

        if ($modelParent->load(Yii::$app->request->post())) {

            $modelChild = Model::createMultiple(RequestChild::classname());
            Model::loadMultiple($modelChild, Yii::$app->request->post());

            // validate all models
            $valid = $modelParent->validate();

            $valid = Model::validateMultiple($modelChild) && $valid;

            $modelParent->id_standard_user_account = $modelParent->getIdCurentStandardUserAccount();

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                        foreach ($modelChild as $Metal) {
                            $modelRequest = new Request();
                            $modelRequest->id_type_delivery = $modelParent->id_type_delivery;
                            $modelRequest->id_city = $modelParent->id_city;
                            $modelRequest->address = $modelParent->address;
                            $modelRequest->id_standard_user_account = $modelParent ->id_standard_user_account;

                            $modelRequest->id_category_scrap = $Metal -> id_category_scrap;
                            $modelRequest->id_category_scrap_gost = $Metal -> id_category_scrap_gost;
                            $modelRequest->id_type_scrap_gost = $Metal -> id_type_scrap_gost;
                            $modelRequest->id_method_payment = $Metal -> id_method_payment;
                            $modelRequest->desired_price = $Metal -> desired_price;
                            $modelRequest->dismantling = $Metal -> dismantling;
                            $modelRequest->category_by_gost = $Metal -> category_by_gost;
                            $modelRequest->mass = $Metal -> mass;

                            if (! ($flag = $modelRequest->save())) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    if ($flag) {
                        $transaction->commit();
                        //return $this->render(['index', 'id' => $modelParent->id]);
                        return $this->render('/site/index');
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }
        return $this->render('create', [
            'modelParent' => $modelParent,
            'modelChild' => (empty($modelChild)) ? [new RequestChild] : $modelChild
        ]);
    }

    /**
     * Lists all Request models.
     * @return mixed
     */
    public function actionIndex($count = 4 )
    {

        $count = !isset($_GET['count']) ? 10 : $_GET['count'];
        $searchModel = new RequestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = $count;

        if($dataProvider == false){
            return $this->actionNotRequest();
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'itemView' =>'_list_request',
        ]);
    }

    public function actionRequestsActivePjax($count = 4){
        $count = !isset($_GET['count']) ? 10 : $_GET['count'];
        $searchModel = new RequestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = $count;

        if($dataProvider == false){
            return $this->actionNotRequest();
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'itemView' =>'_list_request',
        ]);
    }


    /**
     * @return mixed
     */
    public function actionNotRequest()
    {
        return $this->render('notRequest', []);
    }

    /**
     * Отвечает на ajax запрос
     * возвращает html строку с видами металла по гост
     * относяшимися к типу металла переданному в запросе
     */
    public function actionAjax(){

        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();

            $id = explode(":", $data['id']);

            //todo можно перенести в модель в контролере не очень смотриться

            $models = CategoryScrapGost::find()->where(['id_type_scrap_gost' => $id])->all();
            $ids = [];
            $names = [];
            foreach ($models as $model){
                $ids[] = $model->id;
                $names[] = $model->name;
            }
            $search = '';
            for ($i = 0; $i < count($ids); $i++){
                $search = $search. "<option value=".$ids[$i].">".$names[$i]."</option>";
             }
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return [
                'search' => $search,
                'code' => 100,
            ];
        }else{
            return false;
        }
    }
}
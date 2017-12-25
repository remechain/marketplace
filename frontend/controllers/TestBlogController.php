<?php

namespace frontend\controllers;

use Yii;
use backend\models\BlogPages;
use backend\models\BlogPagesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * BlogPagesController implements the CRUD actions for BlogPages model.
 */
class TestBlogController extends Controller
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
     * Lists all BlogPages models.
     * @return mixed
     */
    public function actionIndex()
    {
        if( isset($_GET['categoryBlog'])){
            $categoryBlog = $_GET['categoryBlog'];
        }else{
            $categoryBlog = NULL;
        }
        $searchModel = new BlogPagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categoryBlog' => $categoryBlog,
        ]);
    }
    /**
     * Finds the BlogPages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BlogPages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BlogPages::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

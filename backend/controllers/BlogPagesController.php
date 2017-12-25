<?php

namespace backend\controllers;

use backend\models\EnumeratorBlog;
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
class BlogPagesController extends Controller
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
        $searchModel = new BlogPagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BlogPages model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new BlogPages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BlogPages();

        if ($model->load(Yii::$app->request->post())) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->validate()) {
                $path = Yii::getAlias('@upload-blog');

                $this->createDirectory($path);
                $transaction = Yii::$app->db->beginTransaction();
                $model->preview_img = 'uploads/blog/'.$model->file;

                if($model->save() && $model->file->saveAs(Yii::getAlias('@upload-blog').'/'.$model->file)){
                    $transaction->commit();
                }else{
                    $transaction->rollBack();
                }


                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing BlogPages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = $model::SCENARIO_UPDATE;
        $old_preview_img = $model->preview_img;

        if ($model->load(Yii::$app->request->post())) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if(!empty($model->file)){

                $model->preview_img = 'uploads/blog/'.$model->file;

                $model->file = UploadedFile::getInstance($model, 'file');
                if ($model->validate()) {
                    $path = Yii::getAlias('@upload-blog');

                    $this->createDirectory($path);
                    $transaction = Yii::$app->db->beginTransaction();
                    if($model->save() && $model->file->saveAs(Yii::getAlias('@upload-blog').'/'.$model->file)){
                        $transaction->commit();
                    }else{
                        $transaction->rollBack();
                    }
                }
            }else{
                $model->preview_img = $old_preview_img;
                $transaction = Yii::$app->db->beginTransaction();
                if($model->save()){
                    $transaction->commit();
                }else{
                    $transaction->rollBack();
                }
            }
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
    }

    /**
     * Deletes an existing BlogPages model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        BlogPages::reCountEnumeratorBlog();
        return $this->redirect(['index']);
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

    public function createDirectory($path ) {
        //$filename = "/folder/{$dirname}/";
        if (file_exists($path)) {
            //echo "The directory {$path} exists";
        } else {
            mkdir($path, 0775, true);

            symlink (Yii::getAlias('@upload-blog'),'blog');
            //echo "The directory {$path} was successfully created.";
        }
    }
}

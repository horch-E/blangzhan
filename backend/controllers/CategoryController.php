<?php

namespace backend\controllers;

use Yii;
use backend\models\Category;
use backend\models\CategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


use yii\web\Response;
use yii\widgets\ActiveForm;
// 如此一来，小小的弹窗有一个bug,渲染了布局，我们修改操作create把布局也干掉
use yii\helpers\Url;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
{
    /**
     * 异步校验表单模型
     */
    public function actionValidateForm () 
    {
        // 注意这里实例化是你对应的model
        $model = new Category();
        $model->load(Yii::$app->request->post()); 
        Yii::$app->response->format = Response::FORMAT_JSON; 
        return ActiveForm::validate($model);  
    }

    
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
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Category model.
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
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
public function actionCreate()
{
    $model = new Category();

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
        return $this->redirect(['index']);
        // return $this->redirect(['view', 'id' => $model->id]);
    } else {
        // renderAjax方法，不渲染布局
        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }
}


    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
public function actionUpdate($id)
{
    $model = $this->findModel($id);

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
        return $this->redirect(['index']);
        // return $this->redirect(['view', 'id' => $model->id]);
    } else {
        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }
}

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

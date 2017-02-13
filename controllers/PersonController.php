<?php

namespace andahrm\insignia\controllers;

use Yii;
use andahrm\insignia\models\InsigniaPerson;
use andahrm\insignia\models\InsigniaPersonSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PersonController implements the CRUD actions for InsigniaPerson model.
 */
class PersonController extends Controller
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
     * Lists all InsigniaPerson models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InsigniaPersonSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single InsigniaPerson model.
     * @param integer $insignia_request_id
     * @param integer $user_id
     * @return mixed
     */
    public function actionView($insignia_request_id, $user_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($insignia_request_id, $user_id),
        ]);
    }

    /**
     * Creates a new InsigniaPerson model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new InsigniaPerson();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'insignia_request_id' => $model->insignia_request_id, 'user_id' => $model->user_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing InsigniaPerson model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $insignia_request_id
     * @param integer $user_id
     * @return mixed
     */
    public function actionUpdate($insignia_request_id, $user_id)
    {
        $model = $this->findModel($insignia_request_id, $user_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'insignia_request_id' => $model->insignia_request_id, 'user_id' => $model->user_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing InsigniaPerson model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $insignia_request_id
     * @param integer $user_id
     * @return mixed
     */
    public function actionDelete($insignia_request_id, $user_id)
    {
        $this->findModel($insignia_request_id, $user_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the InsigniaPerson model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $insignia_request_id
     * @param integer $user_id
     * @return InsigniaPerson the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($insignia_request_id, $user_id)
    {
        if (($model = InsigniaPerson::findOne(['insignia_request_id' => $insignia_request_id, 'user_id' => $user_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

<?php

namespace andahrm\insignia\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;
####
use andahrm\edoc\models\EdocInsignia;
use andahrm\insignia\models\EdocInsigniaSearch;
use andahrm\insignia\models\InsigniaPerson;

/**
 * DefaultController implements the CRUD actions for EdocInsignia model.
 */
class DefaultController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
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
     * Lists all EdocInsignia models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new EdocInsigniaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EdocInsignia model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        $model = $this->findModel($id);
        $modelInsignia= $model->insigniaPeople ? $model->insigniaPeople : new InsigniaPerson();
        $dataProvider = null;
        if ($modelInsignia) {
            $dataProvider = new ArrayDataProvider([
                'allModels' => $modelInsignia
            ]);
        }



        return $this->render('view', [
                    'model' => $model,
                    'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Creates a new EdocInsignia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new EdocInsignia();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing EdocInsignia model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing EdocInsignia model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the EdocInsignia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EdocInsignia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = EdocInsignia::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('andahrm/insignia', 'The requested page does not exist.'));
    }

}

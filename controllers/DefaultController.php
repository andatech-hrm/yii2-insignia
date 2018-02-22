<?php

namespace andahrm\insignia\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;
use yii\web\Response;
use yii\widgets\ActiveForm;
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
        $modelInsignia = $model->insigniaPeople ? $model->insigniaPeople : new InsigniaPerson();
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

    public function actionAssignValidate($id, $formAction = null) {
        $model = new InsigniaPerson(['edoc_insignia_id' => $id]);
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

    public function actionAssign($id, $formAction = null, $mode = null, $user_id = null, $insignia_type_id = null) {
        if ($mode == 'del') {
            $model = InsigniaPerson::find()->where([
                        'user_id' => $user_id,
                        'insignia_type_id' => $insignia_type_id,
                        'edoc_insignia_id' => $id,
                    ])->one();
            
            if ($model->delete()) {
                return $this->redirect(['view', 'id' => $model->edoc_insignia_id]);
            }
        } else {
            $model = new InsigniaPerson(['edoc_insignia_id' => $id]);
            $request = Yii::$app->request;
            $post = $request->post();
            $success = false;
            $result = [];

            if ($model->load($post)) {
                Yii::$app->response->format = Response::FORMAT_JSON; //กำหนดการแสดงผลข้อมูลแบบ json
                //print_r($post);
                //exit();
                if ($model->save()) {
                    $success = true;
                    $result = $model;
                } else {
                    $result = $model->getErrors();
                }
                return ['success' => $success, 'result' => $result];
            }

            return $this->renderPartial('assign', [
                        'model' => $model,
                        'formAction' => $formAction
            ]);
        }
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

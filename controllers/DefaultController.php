<?php

namespace andahrm\insignia\controllers;

use Yii;
use andahrm\insignia\models\InsigniaRequest;
use andahrm\insignia\models\InsigniaRequestSearch;
use andahrm\insignia\models\InsigniaPerson;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use beastbytes\wizard\WizardBehavior;

use andahrm\structure\models\PositionLine;
use andahrm\structure\models\Position;
use andahrm\structure\models\PositionLevel;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use andahrm\setting\models\Helper;
/**
 * DefaultController implements the CRUD actions for InsigniaRequest model.
 */
class DefaultController extends Controller
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
    
    
    public function beforeAction($action)
    {
        $config = [];
        switch ($action->id) {
           
            case 'request':
                $config = [
                    'steps' => [
                        Yii::t('andahrm/insignia','Topic') => 'topic',
                        Yii::t('andahrm/insignia','Select Person') => 'person',
                        Yii::t('andahrm/insignia','Assign Insignia') => 'assign',
                        Yii::t('andahrm/insignia','Confirm') => 'confirm',
                    ],
                    'events' => [
                        WizardBehavior::EVENT_WIZARD_STEP => [$this, $action->id.'WizardStep'],
                        WizardBehavior::EVENT_AFTER_WIZARD => [$this, $action->id.'AfterWizard'],
                        WizardBehavior::EVENT_INVALID_STEP => [$this, 'invalidStep']
                    ]
                ];
                break;
            case 'resume':
                $config = ['steps' => []]; // force attachment of WizardBehavior
                
           
            default:
                break;
        }

        if (!empty($config)) {
            $config['class'] = WizardBehavior::className();
            $config['sessionKey'] = 'Wizard-Insignia';
            $this->attachBehavior('wizard', $config);
        }

        return parent::beforeAction($action);
    }

    /**
     * Lists all InsigniaRequest models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InsigniaRequestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort->defaultOrder = [
            'year'=>SORT_DESC
            ];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single InsigniaRequest model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    
    public function actionCertification($id)
    {
        
        $model = $this->findModel($id);
        $model->scenario = 'certification';

        if ($model->load(Yii::$app->request->post())){
            print_r(Yii::$app->request->post());
            if($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                print_r($model->getErrors());
            }
            exit();
        } 
        
        return $this->render('certification', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new InsigniaRequest model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new InsigniaRequest();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing InsigniaRequest model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing InsigniaRequest model.
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
     * Finds the InsigniaRequest model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return InsigniaRequest the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InsigniaRequest::findOne($id)) !== null) {
            $model->year = intval($model->year) + Helper::YEAR_TH_ADD;
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    
    ##############################################################################
    ##############################################################################
    
    public function actionRequest($step = null)
    {
        //$this->layout = 'form-wizard';
        
        //if ($step===null) $this->resetWizard();
        if ($step=='reset') $this->resetWizard();
        return $this->step($step);
    }
    
    public function requestWizardStep($event)
    {
        if (empty($event->stepData)) {
            $modelName = 'andahrm\insignia\models\\'.ucfirst($event->step);
            $model = new $modelName(['scenario'=>'insert']);
        } else {
            $model = $event->stepData;
        }

        $post = Yii::$app->request->post();
        // if(isset($post['_pjax'])){
        //     $modelName = 'andahrm\insignia\models\\'.ucfirst($event->step);
        //     $model = new $modelName(['scenario'=>'insert']);
        //     $this->render('request/'.$event->step, ['model'=>$model]);
        // }
        
        if (isset($post['cancel'])) {
            $event->continue = false;
        } elseif (isset($post['prev'])) {
            $event->nextStep = WizardBehavior::DIRECTION_BACKWARD;
            $event->handled  = true;
        } elseif ($model->load($post) && $model->validate()) {
            $event->data    = $model;
            $event->handled = true;

            if (isset($post['pause'])) {
                $event->continue = false;
            } elseif ($event->n < 2 && isset($post['add'])) {
                $event->nextStep = WizardBehavior::DIRECTION_REPEAT;
            }
            
        } else {
            //print_r($this->read('request'));
            //print_r($model->getErrors());
            //$behavior = $this;
            $event->data = $this->render('request/'.$event->step, compact('event', 'model'));
        }
    }

    /**
    * @param WizardEvent The event
    */
    public function invalidStep($event)
    {
        
        $event->data = $this->render('invalidStep', compact('event'));
        $event->continue = false;
        return $this->redirect(['request']);
    }

    /**
    * Registration wizard has ended; the reason can be determined by the
    * step parameter: TRUE = wizard completed, FALSE = wizard did not start,
    * <string> = the step the wizard stopped at
    * @param WizardEvent The event
    */
    public function requestAfterWizard($event)
    {
        if (is_string($event->step)) {
            $uuid = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
                mt_rand(0, 0xffff), mt_rand(0, 0xffff),
                mt_rand(0, 0xffff),
                mt_rand(0, 0x0fff) | 0x4000,
                mt_rand(0, 0x3fff) | 0x8000,
                mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
            );

            $registrationDir = Yii::getAlias('@runtime/wizard/insignia');
            $registrationDirReady = true;
            if (!file_exists($registrationDir)) {
                if (!mkdir($registrationDir) || !chmod($registrationDir, 0775)) {
                    $registrationDirReady = false;
                }
            }
            if ($registrationDirReady && file_put_contents(
                $registrationDir.DIRECTORY_SEPARATOR.$uuid,
                $event->sender->pauseWizard()
            )) {
                $event->data = $this->render('request/paused', compact('uuid'));
            } else {
                $event->data = $this->render('request/notPaused');
            }
        } elseif ($event->step === null) {
            $event->data = $this->render('request/cancelled');
        } elseif ($event->step) {
            
            
            
            // $model = $event->stepData['topic'][0];
            // if($model->save()){
            //     $event->stepData['topic'][0] = $model;
            //     $modelAssign = $event->stepData['assign'][0];
                
            //     foreach($modelAssign as $assign){
                    
            //     }
            //     $modelAssign->insignia_request_id = $model->id;
            //     $modelAssign->save();
            //     $event->stepData['topic'][0] = $modelDetail;
            // }
            
            //  print_r($event->stepData['topic'][0]);
            //  exit();
            $model = $event->stepData['topic'][0];
            if($model){
            $transaction = \Yii::$app->db->beginTransaction();
            try {
                
                $modelConfirm = $event->stepData['confirm'][0];
                $model->status = InsigniaRequest::STATUS_OFFER;
                //print_r($model);
               
                if ($flag = $model->save(false)) {
                    //$event->stepData['topic'][0] = $model;
                    $modelAssign = $event->stepData['assign'][0];
                    InsigniaPerson::deleteAll(['insignia_request_id'=>$model->id]);
                    print_r($modelAssign->insignia_type_id);
                    foreach ($modelAssign->insignia_type_id as $key => $assign) {
                        $modelPerson = new InsigniaPerson();
                        $modelPerson->insignia_request_id = $model->id;            
                        $modelPerson->user_id = $key;     
                        
                        $modelPerson->last_step = $modelAssign->current_step[$key];
                        $modelPerson->last_adjust_date = $modelAssign->current_adjust_date[$key];
                        $modelPerson->last_salary = $modelAssign->current_salary[$key];            
                        $modelPerson->last_position_id = $modelAssign->current_position_id[$key];            
                        $modelPerson->last_insignia_request_id= $modelAssign->current_insignia_request_id[$key];    
                        
                        $modelPerson->insignia_type_id = $assign;            
                        $modelPerson->note = $modelAssign->note[$key];            
                        if (($flag = $modelPerson->save(false)) === false) {
                            $transaction->rollBack();
                            break;
                        }else{
                            print_r($modelPerson->getErrors());
                        }
                    }
                }
                if ($flag) {
                    $transaction->commit();
                    if ($model->save()) {
                        $this->redirect(['view', 'id' => $model->id]);
                    } else {
                        print_r($model->getErrors());
                    }
                }
            } catch (Exception $e) {
                $transaction->rollBack();
            }
            }
           // exit();
            
            
            $event->data = $this->render('request/complete', [
                'data' => $event->stepData
            ]);
            //$event->continue = false;
            
        } else {
            $event->data = $this->render('request/notStarted');
        }
    }
    
     /**
    * Method description
    *
    * @return mixed The return value
    */
    public function actionResume($uuid)
    {
        $registrationFile = Yii::getAlias('@runtime/wizard/insignia').DIRECTORY_SEPARATOR.$uuid;
        if (file_exists($registrationFile)) {
            $this->resumeWizard(@file_get_contents($registrationFile));
            unlink($registrationFile);
            $this->redirect(['request']);
        } else {
            return $this->render('request/notResumed');
        }
    }
    ######### End Wizard
    
     protected function MapData($datas,$fieldId,$fieldName){
     $obj = [];
     foreach ($datas as $key => $value) {
         array_push($obj, ['id'=>$value->{$fieldId},'name'=>$value->{$fieldName}]);
     }
     return $obj;
    }
 
 ###############
     public function actionGetPersonType() {
     $out = [];
      $post = Yii::$app->request->post();
     if ($post['depdrop_parents']) {
         $parents = $post['depdrop_parents'];
         if ($parents != null) {
             $section_id = $parents[0];
             $out = $this->getPersonType($section_id);
             echo Json::encode(['output'=>$out, 'selected'=>'']);
             return;
         }
         }
         echo Json::encode(['output'=>'', 'selected'=>'']);
     }

      protected function getPersonType($section_id){
         $datas = Position::find()->where(['section_id'=>$section_id])->groupBy('person_type_id')->all();
         return $this->MapData($datas,'person_type_id','personTypeTitle');
     }
 
 #############
    public function actionGetPositionLine() {
     $out = [];
      $post = Yii::$app->request->post();
     if ($post['depdrop_parents']) {
         $parents = $post['depdrop_parents'];
         if ($parents != null) {
             $person_type_id = $parents[0];
             $out = $this->getPositionLine($person_type_id);
             echo Json::encode(['output'=>$out, 'selected'=>'']);
             return;
         }
         }
         echo Json::encode(['output'=>'', 'selected'=>'']);
     }

      protected function getPositionLine($person_type_id){
         $datas = PositionLine::find()
         //->joinWith('position')
         ->where([
             'person_type_id'=>$person_type_id,
             ])
         //->andFilterWhere(['position.person_type_id'=>$person_type_id])
         ->all();
         return $this->MapData($datas,'id','title');
     }
     
     
     public function actionGetPositionLevel() {
     $out = [];
      $post = Yii::$app->request->post();
     if ($post['depdrop_parents']) {
         $parents = $post['depdrop_parents'];
         if ($parents != null) {
             $person_type_id = $parents[0];
             $out = $this->getPositionLevel($person_type_id);
             echo Json::encode(['output'=>$out, 'selected'=>'']);
             return;
         }
         }
         echo Json::encode(['output'=>'', 'selected'=>'']);
     }

      protected function getPositionLevel($person_type_id){
         $datas = PositionLevel::find()
         //->joinWith('position')
         ->where([
             'person_type_id'=>$person_type_id,
             ])
         //->andFilterWhere(['position.person_type_id'=>$person_type_id])
         ->all();
         return $this->MapData($datas,'id','title');
     }
     
     
      public function actionGetPosition() {
     $out = [];
      $post = Yii::$app->request->post();
     if ($post['depdrop_parents']) {
         $parents = $post['depdrop_parents'];
         if ($parents != null) {
             $person_type_id = $parents[0];
             $out = $this->getPosition($person_type_id);
             echo Json::encode(['output'=>$out, 'selected'=>'']);
             return;
         }
         }
         echo Json::encode(['output'=>'', 'selected'=>'']);
     }

      protected function getPosition($person_type_id){
         $datas = Position::find()
         //->joinWith('position')
         ->where([
             'person_type_id'=>$person_type_id,
             ])
         //->andFilterWhere(['position.person_type_id'=>$person_type_id])
         ->all();
         return $this->MapData($datas,'id','title');
     }
     
     
     
    

}
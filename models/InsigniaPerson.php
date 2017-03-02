<?php

namespace andahrm\insignia\models;

use Yii;
use andahrm\structure\models\Position;
/**
 * This is the model class for table "insignia_person".
 *
 * @property integer $insignia_request_id
 * @property integer $user_id
 * @property string $position_current_date
 * @property string $salary
 * @property integer $position_id
 * @property integer $insignia_request_id_last
 * @property integer $insignia_type_id
 * @property string $feat
 * @property string $note
 *
 * @property InsigniaType $insigniaType
 * @property InsigniaRequest $insigniaRequest
 * @property InsigniaRequest $insigniaRequestIdLast
 */
class InsigniaPerson extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'insignia_person';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['insignia_request_id', 'user_id',  'last_adjust_date', 'last_salary', 'last_position_id', 'insignia_type_id'], 'required'],
            [['insignia_request_id', 'user_id',  'last_position_id', 'last_insignia_request_id', 'insignia_type_id'], 'integer'],
            [['last_adjust_date'], 'safe'],
            [['last_salary','last_step'], 'number'],
            [['feat', 'note'], 'string', 'max' => 300],
            [['insignia_request_id'], 'exist', 'skipOnError' => true, 'targetClass' => InsigniaRequest::className(), 'targetAttribute' => ['insignia_request_id' => 'id']],
            [['last_insignia_request_id'], 'exist', 'skipOnError' => true, 'targetClass' => InsigniaRequest::className(), 'targetAttribute' => ['insignia_request_id_last' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'insignia_request_id' => Yii::t('andahrm/insignia', 'Insignia Request'),
            'user_id' => Yii::t('andahrm/insignia', 'Person'),
            'last_step' => Yii::t('andahrm/insignia', 'Last Step'),
            'last_adjust_date' => Yii::t('andahrm/insignia', 'Last Date'),
            'last_salary' => Yii::t('andahrm/insignia', 'Salary'),
            'last_position_id' => Yii::t('andahrm/insignia', 'Last Position'),
            'last_insignia_request_id' => Yii::t('andahrm/insignia', 'Get Last Insignia'),
            'insignia_type_id' => Yii::t('andahrm/insignia', 'This request'),
            'feat' => Yii::t('andahrm/insignia', 'Feat'),
            'note' => Yii::t('andahrm/insignia', 'Note'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInsigniaType()
    {
        return $this->hasOne(InsigniaType::className(), ['id' => 'insignia_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInsigniaRequest()
    {
        return $this->hasOne(InsigniaRequest::className(), ['id' => 'insignia_request_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLastInsigniaRequest()
    {
        return $this->hasOne(InsigniaRequest::className(), ['id' => 'last_insignia_request_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLastInsigniaType()
    {
        // $model = $this->lastInsigniaRequest->where(['insignia_request_id'=>$this->last_insignia_request_id])->one();
        // return $model;
        $model =self::find()->where(['insignia_request_id'=>$this->last_insignia_request_id])->one();
        return $model?$model->insigniaType:null;
    }
    
    public function getUser()
    {
        return $this->hasOne(PersonInsignia::className(), ['user_id' => 'user_id']);
    }
    
    
    
        public function getLevel(){
           return "Level";
       } 
   
       public function getAdjust_date(){
           return "Level";
       }
       
       public function getPosition(){
           return $this->user->position;
       }
       
       public function getLastPosition(){
           return $this->hasOne(Position::className(), ['id' => 'last_position_id']);
       }
       
       public static function getInsigniaTypes($user_id){
         return self::find()
         ->joinWith('insigniaRequest')
         ->where(['user_id'=>$user_id])
         ->orderBy(['insignia_request.created_at'=>SORT_DESC])
         ->one();
       }
}

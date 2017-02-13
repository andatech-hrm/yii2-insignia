<?php

namespace andahrm\insignia\models;

use Yii;
use yii\data\ActiveDataProvider;
use andahrm\positionSalary\models\PersonPositionSalary;
use yii\base\Model;
/**
 * This is the model class for table "insignia_person".
 *
 * @property integer $insignia_request_id
 * @property integer $user_id
 * @property integer $position_level_id
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
class Detail extends InsigniaPerson
{
    public function rules()
    {
        return [
            // [['user_id', 'position_level_id', 'position_current_date', 'salary', 'position_id', 'insignia_type_id'], 'required'],
            // [['insignia_request_id', 'user_id', 'position_level_id', 'position_id', 'insignia_request_id_last', 'insignia_type_id'], 'integer'],
            // [['position_current_date'], 'safe'],
            // [['salary'], 'number'],
            // [['feat', 'note'], 'string', 'max' => 300],
            // [['insignia_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => InsigniaType::className(), 'targetAttribute' => ['insignia_type_id' => 'id']],
            // [['insignia_request_id'], 'exist', 'skipOnError' => true, 'targetClass' => InsigniaRequest::className(), 'targetAttribute' => ['insignia_request_id' => 'id']],
            // [['insignia_request_id_last'], 'exist', 'skipOnError' => true, 'targetClass' => InsigniaRequest::className(), 'targetAttribute' => ['insignia_request_id_last' => 'id']],
        ];
    }
    
    public $insignia_type_id;
    public $note;
    
     public function scenarios(){
          $scenarios = parent::scenarios();
          $scenarios['insert'] = [
              //'user_id', 'position_level_id', 'position_current_date', 'salary', 'position_id',
              'insignia_type_id',
              'note',
              ];
          return $scenarios;
    }
    
    
    
    public static function getPerson($event){
        $data = $event->sender->read('person')[0];
        // $person_type_id = $data->person_type_id;
        // $position_id = $data->position_id;
        // $position_level_id = $data->position_level_id;
        // $year = $data->year;
        
        //print_r($data->selection);
        //exit()
        $query = PersonPositionSalary::find()->joinWith('position')
                ->where(['user_id'=>$data->selection])
                // ->andFilterWhere(['position.person_type_id'=>$person_type_id])
                // ->andFilterWhere(['position.id'=>$position_id])
                // ->andFilterWhere(['position.position_level_id'=>$position_level_id])
                ->groupBy([
                    'user_id',
                  //'position_id',
                    
                ])
                ->orderBy(['adjust_date'=>SORT_ASC]);
                
        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                //'pageSize' => 10,
            ],
            // 'sort' => [
            //     'defaultOrder' => [
            //         'created_at' => SORT_DESC,
            //         'title' => SORT_ASC, 
            //     ]
            // ],
        ]);
        
        return $provider;
    }
    
    
    
    public function beforeValidate()
    {
         if (parent::beforeValidate()) {
            //  print_r(Yii::$app->request->post());
            // exit();
            return true;
        }
        return false;
    }
}

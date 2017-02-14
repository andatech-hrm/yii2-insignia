<?php

namespace andahrm\insignia\models;

use Yii;

/**
 * This is the model class for table "insignia_request".
 *
 * @property integer $id
 * @property integer $person_type_id
 * @property string $year
 * @property integer $insignia_type_id
 * @property integer $sex
 * @property integer $status
 * @property integer $certificate_offer_name
 * @property string $certificate_offer_date
 * @property integer $edoc_id
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_at
 * @property integer $updated_by
 *
 * @property InsigniaPerson[] $insigniaPeople
 * @property InsigniaPerson[] $insigniaPeople0
 * @property InsigniaType $insigniaType
 */
class Topic extends InsigniaRequest
{
    public function rules()
    {
        
        return [
            [['person_type_id', 'year', 'certificate_offer_name', 'sex'], 'required'],
            [['user_selected'], 'safe'],
        ];
    }
    
    
    public $user_selected;
    public $position_line_id;
    public $position_id;
    public $position_level_id;
    
    public function scenarios(){
      $scenarios = parent::scenarios();
      
      $scenarios['insert'] = ['person_type_id', 'year', 'certificate_offer_name', 'sex','user_selected','position_line_id',
      'position_id',
      'position_level_id',
      ];
      
      
      return $scenarios;
    }
    
    
    public function attributeLabels()
    {
        
        $label = parent::attributeLabels();
        $label['position_line_id'] = Yii::t('andahrm/insignia', 'ตำแหน่งในสายงาน');
        $label['position_id'] = Yii::t('andahrm/insignia', 'ตำแหน่ง');
        $label['position_level_id'] = Yii::t('andahrm/insignia', 'ระดับ');
        return $label;
    }
    
    
    
    
}

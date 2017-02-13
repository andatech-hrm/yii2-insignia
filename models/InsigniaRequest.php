<?php

namespace andahrm\insignia\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
use andahrm\structure\models\PersonType;

/**
 * This is the model class for table "insignia_request".
 *
 * @property integer $id
 * @property integer $person_type_id
 * @property string $year
 * @property integer $insignia_type_id
 * @property integer $sex
 * @property integer $status
 * @property string $certificate_offer_name
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
class InsigniaRequest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'insignia_request';
    }
    
     function behaviors()
    {
        
        return [
            [
                'class' => BlameableBehavior::className(),
            ],
            [
                'class' => TimestampBehavior::className(),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'person_type_id', 'year', 'certificate_offer_name'], 'required'],
            [['id', 'person_type_id', 'insignia_type_id', 'sex', 'status', 'edoc_id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['year', 'certificate_offer_date'], 'safe'],
            [['certificate_offer_name'], 'string', 'max' => 200],
            [['insignia_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => InsigniaType::className(), 'targetAttribute' => ['insignia_type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('andahrm/insignia', 'ID'),
            'person_type_id' => Yii::t('andahrm/insignia', 'ประเภทบุคคล'),
            'year' => Yii::t('andahrm/insignia', 'ประจำปี'),
            'insignia_type_id' => Yii::t('andahrm/insignia', 'ประเภทเครื่องราชฯ'),
            'sex' => Yii::t('andahrm/insignia', 'กลุ่มเพศ'),
            'status' => Yii::t('andahrm/insignia', 'สถานะ'),
            'certificate_offer_name' => Yii::t('andahrm/insignia', 'ผู้รับรองเสนอขอพระราชทาน'),
            'certificate_offer_date' => Yii::t('andahrm/insignia', 'ร้บรองเมื่อวันที่'),
            'edoc_id' => Yii::t('andahrm/insignia', 'เอกสารอ้างอิง'),
            'created_at' => Yii::t('andahrm/insignia', 'Created At'),
            'created_by' => Yii::t('andahrm/insignia', 'Created By'),
            'updated_at' => Yii::t('andahrm/insignia', 'Updated At'),
            'updated_by' => Yii::t('andahrm/insignia', 'Updated By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInsigniaPeople()
    {
        return $this->hasMany(InsigniaPerson::className(), ['insignia_request_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInsigniaPeople0()
    {
        return $this->hasMany(InsigniaPerson::className(), ['insignia_request_id_last' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInsigniaType()
    {
        return $this->hasOne(InsigniaType::className(), ['id' => 'insignia_type_id']);
    }
    
    public static function getListCertificator(){
        $model = self::find()->select('certificate_offer_name')->distinct()->groupBy(['certificate_offer_name'])->all();
        return ArrayHelper::getColumn($model,'certificate_offer_name');
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonType()
    {
        return $this->hasOne(PersonType::className(), ['id' => 'person_type_id']);
    }
    
    public function getYearTh()
    {
        return $this->year+543;
    }
}

<?php

namespace andahrm\insignia\models;

use Yii;

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
            [['insignia_request_id', 'user_id', 'position_level_id', 'position_current_date', 'salary', 'position_id', 'insignia_type_id'], 'required'],
            [['insignia_request_id', 'user_id', 'position_level_id', 'position_id', 'insignia_request_id_last', 'insignia_type_id'], 'integer'],
            [['position_current_date'], 'safe'],
            [['salary'], 'number'],
            [['feat', 'note'], 'string', 'max' => 300],
            [['insignia_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => InsigniaType::className(), 'targetAttribute' => ['insignia_type_id' => 'id']],
            [['insignia_request_id'], 'exist', 'skipOnError' => true, 'targetClass' => InsigniaRequest::className(), 'targetAttribute' => ['insignia_request_id' => 'id']],
            [['insignia_request_id_last'], 'exist', 'skipOnError' => true, 'targetClass' => InsigniaRequest::className(), 'targetAttribute' => ['insignia_request_id_last' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'insignia_request_id' => Yii::t('andahrm/insignia', 'การขอเครื่องราชฯ'),
            'user_id' => Yii::t('andahrm/insignia', 'User ID'),
            'position_level_id' => Yii::t('andahrm/insignia', 'ระดับ'),
            'position_current_date' => Yii::t('andahrm/insignia', 'วันที่ล่าสุด'),
            'salary' => Yii::t('andahrm/insignia', 'Salary'),
            'position_id' => Yii::t('andahrm/insignia', 'ตำแหน่งปัจจุบัน'),
            'insignia_request_id_last' => Yii::t('andahrm/insignia', 'ได้รับเครื่องราชครั้งสุดท้าย'),
            'insignia_type_id' => Yii::t('andahrm/insignia', 'ขอครั้งนี้'),
            'feat' => Yii::t('andahrm/insignia', 'ความดีความชอบดีเด่น'),
            'note' => Yii::t('andahrm/insignia', 'หมายเหตุ'),
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
    public function getInsigniaRequestIdLast()
    {
        return $this->hasOne(InsigniaRequest::className(), ['id' => 'insignia_request_id_last']);
    }
}

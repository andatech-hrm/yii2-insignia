<?php

namespace andahrm\insignia\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
######
use andahrm\edoc\models\EdocInsignia;
use andahrm\datepicker\behaviors\DateBuddhistBehavior;

/**
 * This is the model class for table "insignia_person".
 *
 * @property int $insignia_type_id
 * @property string $yearly
 * @property string $salary
 * @property int $position_id ตำแหน่งปัจจุบัน
 * @property string $feat ความดีความชอบดีเด่น
 * @property string $note หมายเหตุ
 * @property int $edoc_insignia_id
 * @property int $user_id
 *
 * @property EdocInsignia $edocInsignia
 * @property Person $user
 * @property InsigniaType $insigniaType
 */
class InsigniaPerson extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'insignia_person';
    }

    function behaviors() {

        return [
                [
                'class' => BlameableBehavior::className(),
            ],
                [
                'class' => TimestampBehavior::className(),
            ],
            'certificate_offer_date' => [
                'class' => DateBuddhistBehavior::className(),
                'dateAttribute' => 'certificate_offer_date',
            ],
                // 'year' => [
                //     'class' => YearBuddhistBehavior::className(),
                //     'attribute' => 'year',
                // ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['insignia_type_id', 'yearly', 'user_id'], 'required'],
                [['insignia_type_id', 'position_id', 'edoc_insignia_id', 'user_id'], 'integer'],
                [['yearly'], 'safe'],
                [['salary'], 'number'],
                [['feat', 'note'], 'string', 'max' => 300],
                [['insignia_type_id', 'yearly', 'user_id'], 'unique', 'targetAttribute' => ['insignia_type_id', 'yearly', 'user_id']],
                [['edoc_insignia_id'], 'exist', 'skipOnError' => true, 'targetClass' => EdocInsignia::className(), 'targetAttribute' => ['edoc_insignia_id' => 'id']],
                [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Person::className(), 'targetAttribute' => ['user_id' => 'user_id']],
                [['insignia_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => InsigniaType::className(), 'targetAttribute' => ['insignia_type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'insignia_type_id' => Yii::t('andahrm/insignia', 'Insignia Type ID'),
            'yearly' => Yii::t('andahrm/insignia', 'Yearly'),
            'salary' => Yii::t('andahrm/insignia', 'Salary'),
            'position_id' => Yii::t('andahrm/insignia', 'Position ID'),
            'feat' => Yii::t('andahrm/insignia', 'Feat'),
            'note' => Yii::t('andahrm/insignia', 'Note'),
            'edoc_insignia_id' => Yii::t('andahrm/insignia', 'Edoc Insignia ID'),
            'user_id' => Yii::t('andahrm/insignia', 'User ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEdocInsignia() {
        return $this->hasOne(EdocInsignia::className(), ['id' => 'edoc_insignia_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(Person::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInsigniaType() {
        return $this->hasOne(InsigniaType::className(), ['id' => 'insignia_type_id']);
    }

    #check exists record

    public function getExists() {
        return self::find()->where([
                    'user_id' => $this->user_id,
                    'insignia_type_id' => $this->insignia_type_id,
                ])->exists();
    }

    public function getYearTh() {
        return $this->yearly + 543;
    }

}

<?php

namespace andahrm\insignia\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
##
use andahrm\setting\models\Helper;
use andahrm\structure\models\PersonType;
use andahrm\edoc\models\Edoc;
use andahrm\datepicker\behaviors\DateBuddhistBehavior;
use andahrm\datepicker\behaviors\YearBuddhistBehavior;

/**
 * This is the model class for table "insignia_request".
 *
 * @property integer $id
 * @property integer $person_type_id
 * @property string $year
 * @property integer $insignia_type_id
 * @property integer $gender
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
class InsigniaRequest extends ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'insignia_request';
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
                [['id', 'person_type_id', 'year', 'certificate_offer_name'], 'required'],
                [['id', 'person_type_id', 'insignia_type_id', 'gender', 'status', 'edoc_id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
                [['year', 'certificate_offer_date'], 'safe'],
                [['certificate_offer_name'], 'string', 'max' => 200],
                [['insignia_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => InsigniaType::className(), 'targetAttribute' => ['insignia_type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('andahrm/insignia', 'ID'),
            'person_type_id' => Yii::t('andahrm/insignia', 'Person Type'),
            'year' => Yii::t('andahrm/insignia', 'Year'),
            'insignia_type_id' => Yii::t('andahrm/insignia', 'Insignia Type'),
            'gender' => Yii::t('andahrm/insignia', 'Gender'),
            'status' => Yii::t('andahrm/insignia', 'Status'),
            'certificate_offer_name' => Yii::t('andahrm/insignia', 'The certification offered clemency'),
            'certificate_offer_date' => Yii::t('andahrm/insignia', 'Certification on'),
            'edoc_id' => Yii::t('andahrm/insignia', 'reference'),
            'created_at' => Yii::t('andahrm', 'Created At'),
            'created_by' => Yii::t('andahrm', 'Created By'),
            'updated_at' => Yii::t('andahrm', 'Updated At'),
            'updated_by' => Yii::t('andahrm', 'Updated By'),
        ];
    }

    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios['certification'] = ['status', 'certificate_offer_date', 'edoc_id'];

        return $scenarios;
    }

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            if ($certificate_offer_date = \DateTime::createFromFormat(Helper::UI_DATE_FORMAT, $this->certificate_offer_date)) {
                $this->certificate_offer_date = $certificate_offer_date->format(Helper::DB_DATE_FORMAT);
            }
            return true;
        } else {
            return false;
        }
    }

    public function afterFind() {
        if ($certificate_offer_date = \DateTime::createFromFormat(Helper::DB_DATE_FORMAT, $this->certificate_offer_date)) {
            $this->certificate_offer_date = $certificate_offer_date->format(Helper::UI_DATE_FORMAT);
        }
    }

    const STATUS_NONE = null;
    const STATUS_DRAFT = 0;
    const STATUS_OFFER = 1;
    const STATUS_ALLOW = 2;
    const STATUS_DISALLOW = 3;
    const STATUS_CANCEL = 4;

    public static function itemsAlias($key) {
        $items = [
            'status' => [
                self::STATUS_NONE => Yii::t('andahrm/insignia', 'Null'),
                self::STATUS_OFFER => Yii::t('andahrm/insignia', 'Offer'),
                self::STATUS_ALLOW => Yii::t('andahrm/insignia', 'Allow'),
                self::STATUS_DISALLOW => Yii::t('andahrm/insignia', 'Disallow'),
                self::STATUS_CANCEL => Yii::t('andahrm/insignia', 'Cancel'),
            ],
            'status_consider' => [
                self::STATUS_ALLOW => Yii::t('andahrm/insignia', 'Allow'),
                self::STATUS_DISALLOW => Yii::t('andahrm/insignia', 'Disallow'),
            ]
        ];
        return ArrayHelper::getValue($items, $key, []);
    }

    public function getStatusLabel() {
        return ArrayHelper::getValue($this->getItemStatus(), $this->status);
    }

    public static function getItemStatus() {
        return self::itemsAlias('status');
    }

    public static function getItemStatusConsider() {
        return self::itemsAlias('status_consider');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInsigniaPeople() {
        return $this->hasMany(InsigniaPerson::className(), ['insignia_request_id' => 'id']);
    }

    public function getCountPeople() {
        $num = count($this->insigniaPeople);
        return ($num ? $num : '-') . ' คน';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInsigniaPeople0() {
        return $this->hasMany(InsigniaPerson::className(), ['insignia_request_id_last' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInsigniaType() {
        return $this->hasOne(InsigniaType::className(), ['id' => 'insignia_type_id']);
    }

    public static function getListCertificator() {
        $model = self::find()->select('certificate_offer_name')->distinct()->groupBy(['certificate_offer_name'])->all();
        return ArrayHelper::getColumn($model, 'certificate_offer_name');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonType() {
        return $this->hasOne(PersonType::className(), ['id' => 'person_type_id']);
    }

    public function getYearTh() {
        return $this->year + 543;
    }

    public function getYearBuddhist() {
        $yearDistance = $this->getBehavior('year')->yearDistance;
        return (intval($this->year) + $yearDistance);
    }

    public static function getGenders() {
        return PersonInsignia::getGenders();
    }

    public function getGenderText() {
        $genders = self::getGenders();
        if (array_key_exists($this->gender, $genders)) {
            return $genders[$this->gender];
        }
        return null;
    }

    public static function getFormTemplate($person_type_id) {
        $temp = '';
        switch ($person_type_id) {
            case 1:
            case 9:
                $temp = '_template_gov';
                break;

            case 2:
            case 3:
            case 4:
                $temp = '_template_gov';
                break;

            case 8:
                $temp = '_template_gov';
                break;
        }
        return $temp;
    }

    public function getViewTemplate() {
        $temp = '';
        switch ($this->person_type_id) {
            case 1:
            case 9:
                $temp = '_view_template_gov';
                break;

            case 2:
            case 3:
            case 4:
                $temp = '_view_template_gov';
                break;

            case 8:
                $temp = '_view_template_gov';
                break;
        }
        return $temp;
    }

    public function getEdoc() {
        return $this->hasOne(Edoc::className(), ['id' => 'edoc_id']);
    }

}

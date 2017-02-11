<?php

namespace andahrm\insignia\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use anda\core\widgets\cropimageupload\CropImageUploadBehavior;
/**
 * This is the model class for table "insignia_type".
 *
 * @property integer $id
 * @property string $title
 * @property string $title
 * @property integer $status
 * @property string $marker
 * @property string $marker_scope
 * @property string $marker_cropped
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_at
 * @property integer $updated_by
 *
 * @property InsigniaPerson[] $insigniaPeople
 * @property InsigniaRequest[] $insigniaRequests
 */
class InsigniaType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'insignia_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title_full', 'title', 'status'], 'required'],
            [['status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['title_full'], 'string', 'max' => 255],
            [['title'], 'string', 'max' => 10],
            //[['marker', 'marker_scope', 'marker_cropped'], 'string', 'max' => 255],
            ['marker', 'file', 'extensions' => 'jpg, jpeg, gif, png', 'on' => ['insert', 'update']],
            [['title_full'], 'unique'],
            [['title'], 'unique'],
            ['status','default','value'=>1]
        ];
    }
    
    function behaviors()
    {
        if(!is_dir(Yii::getAlias('@uploads/insignia-marker'))){
            \yii\helpers\FileHelper::createDirectory(Yii::getAlias('@uploads/insignia-marker'));
        }
        return [
            [
                'class' => BlameableBehavior::className(),
            ],
            [
                'class' => TimestampBehavior::className(),
            ],
            'marker' => [
                'class' => CropImageUploadBehavior::className(),
                'attribute' => 'marker',
                'scenarios' => ['insert', 'update'],
                'path' => '@uploads/insignia-marker/{id}',
                'url' => '/uploads/insignia-marker/{id}',
                'ratio' => 4,
                'resize' => [100,30],
                'crop_field' => 'marker_scope',
                'cropped_field' => 'marker_cropped',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('andahrm/insignia', 'ID'),
            'title_full' => Yii::t('andahrm/insignia', 'ชื่อเต็ม'),
            'title' => Yii::t('andahrm/insignia', 'ชื่อย่อ'),
            'status' => Yii::t('andahrm/insignia', 'สถานะ'),
            'marker' => Yii::t('andahrm/insignia', 'เครื่องหมายแพรแถบ'),
            'marker_scope' => Yii::t('andahrm/insignia', 'Marker Scope'),
            'marker_cropped' => Yii::t('andahrm/insignia', 'Marker Croped'),
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
        return $this->hasMany(InsigniaPerson::className(), ['insignia_type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInsigniaRequests()
    {
        return $this->hasMany(InsigniaRequest::className(), ['insignia_type_id' => 'id']);
    }
}

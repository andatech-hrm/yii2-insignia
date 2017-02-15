<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

use andahrm\insignia\models\InsigniaRequest;
use andahrm\insignia\models\InsigniaType;

use andahrm\structure\models\PersonType;
use andahrm\structure\models\FiscalYear;
/* @var $this yii\web\View */
/* @var $searchModel andahrm\insignia\models\InsigniaRequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('andahrm/insignia', 'Insignia Requests');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="insignia-request-index">
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('andahrm/insignia', 'Create Insignia Request'), ['request'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute'=> 'person_type_id',
                'filter'=>PersonType::getForInsignia(),
                'value' => 'personType.title'
                ],
            [
                'attribute'=> 'year',
                'filter'=>FiscalYear::getList(),
                'value' => 'yearTh'
                ],
            [
                'attribute'=> 'insignia_type_id',
                'filter'=>InsigniaType::getList(),
                'format'=>'html',
                'value' => 'insigniaType.titleIcon'
                ],
                [
                'attribute'=> 'gender',
                'filter'=>InsigniaRequest::getGenders(),
                'value' => 'genderText'
                ],
                [
                'label'=> 'จำนวนผู้ขอ',
                //'filter'=>InsigniaRequest::getItemStatus(),
                'value' => 'countPeople'
                ],
                [
                'attribute'=> 'status',
                'filter'=>InsigniaRequest::getItemStatus(),
                'value' => 'statusLabel'
                ],
           
            // 'certificate_offer_name',
            // 'certificate_offer_date',
            // 'edoc_id',
             'created_at:datetime',
             'created_by',
            // 'updated_at',
            // 'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

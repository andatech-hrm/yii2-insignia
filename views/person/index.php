<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel andahrm\insignia\models\InsigniaPersonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('andahrm/insignia', 'Insignia People');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="insignia-person-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('andahrm/insignia', 'Create Insignia Person'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'insignia_request_id',
            'user_id',
            'last_step',
            'last_adjust_date',
            'last_salary',
            // 'last_position_id',
            // 'last_edoc_id',
            // 'last_insignia_request_id',
            // 'insignia_type_id',
            // 'feat',
            // 'note',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel andahrm\insignia\models\EdocInsigniaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = Yii::t('andahrm/insignia', 'Insignia Requests');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="edoc-insignia-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

     <p>
        <?= Html::a(Yii::t('andahrm/insignia', 'Create Insignia Request'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'book_number',
            'part_number',
            'book_at',
            'public_date:date',
            'book_date:date',
            //'file',
            //'file_name',
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

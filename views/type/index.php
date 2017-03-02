<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel andahrm\insignia\models\InsigniaTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('andahrm/insignia', 'Insignia Types');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="insignia-type-index">
    

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('andahrm/insignia', 'Create Insignia Type'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'marker',
                'format' => 'html',
                'value' => function($model){
                    return Html::img($model->getUploadUrl('marker'), [
                        'class' => 'img-responsive img-cropped-preview', 
                        'id' => 'preview',
                        'width'=>'100'
                        ]);
                }
            
            ],
            
            'title',
            'title_full',
            // 'status',
            //'marker',
            // 'marker_scope',
            // 'marker_cropped',
            //  'created_at',
            //  'created_by',
            // 'updated_at',
            // 'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

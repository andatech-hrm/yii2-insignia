<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model andahrm\edoc\models\EdocInsignia */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('andahrm/insignia', 'Edoc Insignias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


$modals['position'] = Modal::begin([
            'header' => Yii::t('andahrm/insignia', 'Assign Insignia'),
            'size' => Modal::SIZE_LARGE
        ]);
//echo Yii::$app->runAction('/insignia/default/assign', ['formAction' => Url::to(['/insignia/default/assign','id'=>$model->id]),'id'=>$model->id]);

Modal::end();
?>
<div class="edoc-insignia-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('andahrm/insignia', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a(Yii::t('andahrm/insignia', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('andahrm/insignia', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'book_number',
            'part_number',
            'book_at',
            'public_date',
            'book_date',
            'file',
            'file_name',
//            'created_at',
//            'created_by',
//            'updated_at',
//            'updated_by',
        ],
    ])
    ?>


    <?php
    echo Yii::$app->runAction('/insignia/default/assign', ['formAction' => Url::to(['/insignia/default/assign', 'id' => $model->id]), 'id' => $model->id]);
    ?>

    
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                'attribute' => 'user_id',
                'value' => function($model) {
                    return $model->person->fullname;
                }
            ],
                [
                'attribute' => 'insignia_type_id',
                'format' => 'html',
                'value' => function($model) {
                    return $model->insigniaType->titleIcon;
                }
            ],
                [
//                'header' => Html::button('เพิ่ม', [
//                    'class' => 'btn btn-success',
//                    "data-toggle" => "modal",
//                    "data-target" => "#{$modals['position']->id}"
//                ]),
                'content' => function($model) {
                    return Html::a('ลบ', [
                                'assign',
                                'id' => $model->edoc_insignia_id,
                                'user_id'=>$model->user_id,
                                'insignia_type_id'=>$model->insignia_type_id,
                                'mode' => 'del'
                                    ], ['class' => 'btn btn-danger']);
                }
            ],
        ]
    ]);
    ?>




</div>

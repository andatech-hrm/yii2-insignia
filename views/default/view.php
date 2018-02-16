<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model andahrm\edoc\models\EdocInsignia */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('andahrm/insignia', 'Edoc Insignias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
        ],
    ])
    ?>


    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
    ]);
    ?>




</div>

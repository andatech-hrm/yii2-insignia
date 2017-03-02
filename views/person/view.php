<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model andahrm\insignia\models\InsigniaPerson */

$this->title = $model->insignia_request_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('andahrm/insignia', 'Insignia People'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="insignia-person-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('andahrm/insignia', 'Update'), ['update', 'insignia_request_id' => $model->insignia_request_id, 'user_id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('andahrm/insignia', 'Delete'), ['delete', 'insignia_request_id' => $model->insignia_request_id, 'user_id' => $model->user_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('andahrm/insignia', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'insignia_request_id',
            'user_id',
            'last_step',
            'last_adjust_date',
            'last_salary',
            'last_position_id',
            'last_edoc_id',
            'last_insignia_request_id',
            'insignia_type_id',
            'feat',
            'note',
        ],
    ]) ?>

</div>

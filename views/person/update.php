<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model andahrm\insignia\models\InsigniaPerson */

$this->title = Yii::t('andahrm/insignia', 'Update {modelClass}: ', [
    'modelClass' => 'Insignia Person',
]) . $model->insignia_request_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('andahrm/insignia', 'Insignia People'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->insignia_request_id, 'url' => ['view', 'insignia_request_id' => $model->insignia_request_id, 'user_id' => $model->user_id]];
$this->params['breadcrumbs'][] = Yii::t('andahrm/insignia', 'Update');
?>
<div class="insignia-person-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

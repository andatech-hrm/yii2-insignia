<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model andahrm\insignia\models\InsigniaRequest */

$this->title = Yii::t('andahrm/insignia', 'Update {modelClass}: ', [
    'modelClass' => 'Insignia Request',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('andahrm/insignia', 'Insignia Requests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('andahrm/insignia', 'Update');
?>
<div class="insignia-request-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

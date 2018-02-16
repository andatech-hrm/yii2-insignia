<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model andahrm\edoc\models\EdocInsignia */

$this->title = Yii::t('andahrm/insignia', 'Update Edoc Insignia: ' . $model->id, [
    'nameAttribute' => '' . $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('andahrm/insignia', 'Edoc Insignias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('andahrm/insignia', 'Update');
?>
<div class="edoc-insignia-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

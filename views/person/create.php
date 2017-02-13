<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model andahrm\insignia\models\InsigniaPerson */

$this->title = Yii::t('andahrm/insignia', 'Create Insignia Person');
$this->params['breadcrumbs'][] = ['label' => Yii::t('andahrm/insignia', 'Insignia People'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="insignia-person-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

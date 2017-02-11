<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model andahrm\insignia\models\InsigniaType */

$this->title = Yii::t('andahrm/insignia', 'Create Insignia Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('andahrm/insignia', 'Insignia Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="insignia-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

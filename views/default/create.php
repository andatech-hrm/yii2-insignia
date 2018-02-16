<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model andahrm\edoc\models\EdocInsignia */

$this->title = Yii::t('andahrm/insignia', 'Create Edoc Insignia');
$this->params['breadcrumbs'][] = ['label' => Yii::t('andahrm/insignia', 'Edoc Insignias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="edoc-insignia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

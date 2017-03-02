<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model andahrm\insignia\models\InsigniaRequest */

$this->title = Yii::t('andahrm/insignia', 'Insignia Requests Form :') .$model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('andahrm/insignia', 'Insignia Requests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="insignia-request-view">
    <?php /*
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('andahrm', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('andahrm', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('andahrm', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
*/?>

            <?=$this->render($model->viewTemplate,[
                 //'event'=>$event,
                 //'model'=>$model
                 'person_type' => $model->personType->title,
                 'insigniaType' => $model->insigniaType?$model->insigniaType->title:' - ',
                 'gender' => $model->gender?'('.$model->genderText.')':'',
                 'year' => $model->yearTh,
                 'person' => $model->insigniaPeople,
                 //'assign' => $stepAssign,
                 'modelRequest'=>$model,
             ]);?>

</div>

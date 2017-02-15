<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model andahrm\insignia\models\InsigniaRequest */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('andahrm/insignia', 'Insignia Requests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="insignia-request-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('andahrm/insignia', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('andahrm/insignia', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('andahrm/insignia', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>


            <?=$this->render('_template_gov',[
                 //'event'=>$event,
                 //'model'=>$model
                 'person_type' => $model->personType->title,
                 'year' => $model->yearTh,
                 'person' => $model->insigniaPeople,
                 'assign' => $stepAssign
             ]);?>


    <?php /*= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'person_type_id',
            'year',
            'insignia_type_id',
            'gender',
            'status',
            'certificate_offer_name',
            'certificate_offer_date',
            'edoc_id',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
        ],
    ]) */?>

</div>

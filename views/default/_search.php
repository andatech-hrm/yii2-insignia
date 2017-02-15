<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model andahrm\insignia\models\InsigniaRequestSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="insignia-request-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'person_type_id') ?>

    <?= $form->field($model, 'year') ?>

    <?= $form->field($model, 'insignia_type_id') ?>

    <?= $form->field($model, 'gender') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'certificate_offer_name') ?>

    <?php // echo $form->field($model, 'certificate_offer_date') ?>

    <?php // echo $form->field($model, 'edoc_id') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('andahrm/insignia', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('andahrm/insignia', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

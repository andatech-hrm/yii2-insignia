<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model andahrm\insignia\models\InsigniaPersonSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="insignia-person-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'insignia_request_id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'last_step') ?>

    <?= $form->field($model, 'last_adjust_date') ?>

    <?= $form->field($model, 'last_salary') ?>

    <?php // echo $form->field($model, 'last_position_id') ?>

    <?php // echo $form->field($model, 'last_edoc_id') ?>

    <?php // echo $form->field($model, 'last_insignia_request_id') ?>

    <?php // echo $form->field($model, 'insignia_type_id') ?>

    <?php // echo $form->field($model, 'feat') ?>

    <?php // echo $form->field($model, 'note') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('andahrm/insignia', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('andahrm/insignia', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

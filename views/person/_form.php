<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model andahrm\insignia\models\InsigniaPerson */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="insignia-person-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'insignia_request_id')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'last_step')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_adjust_date')->textInput() ?>

    <?= $form->field($model, 'last_salary')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_position_id')->textInput() ?>

    <?= $form->field($model, 'last_insignia_request_id')->textInput() ?>

    <?= $form->field($model, 'insignia_type_id')->textInput() ?>

    <?= $form->field($model, 'feat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('andahrm/insignia', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

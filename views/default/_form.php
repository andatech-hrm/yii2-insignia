<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use andahrm\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model andahrm\insignia\models\InsigniaRequest */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="insignia-request-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'person_type_id')->textInput() ?>

    <?= $form->field($model, 'year')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'insignia_type_id')->textInput() ?>

    <?= $form->field($model, 'gender')->inline()->radioList($model->genders) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'certificate_offer_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'certificate_offer_date')->widget(DatePicker::className());?>

    <?= $form->field($model, 'edoc_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('andahrm/insignia', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

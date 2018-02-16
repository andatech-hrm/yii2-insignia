<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model andahrm\insignia\models\EdocInsigniaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="edoc-insignia-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'book_number') ?>

    <?= $form->field($model, 'part_number') ?>

    <?= $form->field($model, 'book_at') ?>

    <?= $form->field($model, 'public_date') ?>

    <?php // echo $form->field($model, 'book_date') ?>

    <?php // echo $form->field($model, 'file') ?>

    <?php // echo $form->field($model, 'file_name') ?>

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

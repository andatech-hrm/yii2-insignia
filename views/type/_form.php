<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model andahrm\insignia\models\InsigniaType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="insignia-type-form">

    <?php $form = ActiveForm::begin([
    'options' => [
        'enctype' => 'multipart/form-data',
    ]
]); ?>

    <?= $this->render('_form-marker',['form'=>$form,'model'=>$model]); ?>
    
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title_full')->textInput(['maxlength' => true]) ?>
    

    <?php /*= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'marker')->textInput(['maxlength' => true]) */ ?>
    


    <div class="form-group">
        <?= Html::submitButton(Yii::t('andahrm/insignia', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

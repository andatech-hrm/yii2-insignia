<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use andahrm\datepicker\DatePicker;
use kartik\widgets\FileInput;
use andahrm\setting\models\WidgetSettings;

/* @var $this yii\web\View */
/* @var $model andahrm\edoc\models\EdocInsignia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="edoc-insignia-form">

    <?php $form = ActiveForm::begin(); ?>


    <div class="row">
        <div class="col-sm-3">   
            <?php echo $form->field($model, 'book_number')->textInput(); ?>
        </div>

        <div class="col-sm-3">   
            <?php echo $form->field($model, 'part_number')->textInput(); ?>
        </div>

        <div class="col-sm-3">   
            <?php echo $form->field($model, 'book_at')->textInput(); ?>
        </div>      


        <div class="col-sm-3">        
            <?php echo $form->field($model, 'book_date')->widget(DatePicker::classname(), WidgetSettings::DatePicker()); ?>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-3">        
            <?php echo $form->field($model, 'page_number')->textInput(); ?>
        </div>
        <div class="col-sm-3">        
            <?php echo $form->field($model, 'public_date')->widget(DatePicker::classname(), WidgetSettings::DatePicker()); ?>
        </div>
        <div class="col-sm-6">
            <?=
            $form->field($model, 'file')->widget(FileInput::classname(), [
                'options' => ['accept' => ['pdf/*', 'image/*']],
                'pluginOptions' => [
                    'previewFileType' => 'pdf',
                    //'elCaptionText' => '#customCaption',
                    'uploadUrl' => Url::to(['/edoc/default/file-upload']),
                    'showPreview' => false,
                    'showCaption' => true,
                    'showRemove' => true,
                    'showUpload' => false,
                ],
            ]);
            ?>
            <span id="customCaption" class="text-success">No file selected</span>




        </div>
    </div>

    <hr/>



    <div class="form-group">
        <?= Html::submitButton(Yii::t('andahrm/insignia', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

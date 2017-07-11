<?php

use yii\helpers\Html;
use yii\helpers\Json;
use yii\bootstrap\ActiveForm;
use andahrm\insignia\models\InsigniaRequest;

use andahrm\setting\models\WidgetSettings;
use kartik\widgets\Select2;

use yii\bootstrap\Modal;
use andahrm\datepicker\DatePicker;
use kartik\widgets\FileInput;
use kartik\widgets\Typeahead;
use yii\helpers\Url;
use yii\web\JsExpression;
use andahrm\edoc\models\Edoc;
use andahrm\edoc\models\EdocSearch;

/* @var $this yii\web\View */
/* @var $model andahrm\insignia\models\InsigniaRequest */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('andahrm/insignia', 'Insignia Requests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
$modals['edoc'] = Modal::begin([
    'header' => Yii::t('andahrm/person', 'Edoc'),
    'size' => Modal::SIZE_LARGE
]);
// echo $this->render('@andahrm/edoc/views/default/_form', ['model' => new \andahrm\edoc\models\Edoc(), ]);
echo Yii::$app->runAction('/edoc/default/create-ajax', ['formAction' => Url::to(['/edoc/default/create-ajax'])]);
// echo '<iframe src="" frameborder="0" style="width:100%; height: 100%;" id="iframe_edoc_create"></iframe>';
            
Modal::end();
?>
<div class="insignia-request-view">
    

    <?=$this->render($model->viewTemplate,[
         //'event'=>$event,
         //'model'=>$model
         'person_type' => $model->personType->title,
         'insigniaType' => $model->insigniaType?$model->insigniaType->title:' - ',
         'gender' => $model->gender?'('.$model->genderText.')':'',
         'year' => $model->yearTh,
         'person' => $model->insigniaPeople,
         //'assign' => $stepAssign
     ]);?>


</div>
<hr/>

<?=Html::tag('h2','ลงการรับรอง')?>
<div class="insignia-request-form">

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>  

 <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>

<div class="row">
<div class="col-sm-6">
     <?= $form->field($model, 'certificate_offer_date')->widget(DatePicker::classname(), WidgetSettings::DatePicker());?>
 </div>
 
<div class="col-sm-6">
<?php
$edocInputTemplate = <<< HTML
    <div class="input-group">
        {input}
        <span class="input-group-btn">
            <button type="button" class="btn btn-success" role="edoc" data-toggle="modal" data-target="#{$modals['edoc']->id}"><i class="fa fa-plus"></i></button>
        </span>
    </div>
HTML;
?>
    
    <?= $form->field($model, "edoc_id", [
        'inputTemplate' => $edocInputTemplate,
        'options' => [
            'class' => 'form-group col-sm-6'
        ]
    ])->widget(Select2::className(), WidgetSettings::Select2(['data' => Edoc::getList()])) ?>
 </div>           
 </div>           

   <div class="row">
<div class="col-sm-6">

    <?= $form->field($model, 'status')->radioList(InsigniaRequest::getItemStatusConsider())?>

   </div>           
 </div>   

    <div class="form-group">
        <?= Html::submitButton(Yii::t('andahrm/insignia', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>



</div>

<?php
$edocInputId = Html::getInputId($model, 'edoc_id');
$jsHead = [];
$jsHead[] = <<< JS
    function callbackEdoc(result)
    {   
        $("#{$edocInputId}").append($('<option>', {
            value: result.id,
            text: result.code + ' - ' + result.title
        }));
        $("#{$edocInputId}").val(result.id).trigger('change.select2');
        
        $("#{$modals['edoc']->id}").modal('hide');
    }
JS;


$this->registerJs(implode("\n", $jsHead), $this::POS_HEAD);

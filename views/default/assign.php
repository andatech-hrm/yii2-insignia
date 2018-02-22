<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\web\JsExpression;
use andahrm\datepicker\DatePicker;
use kartik\widgets\FileInput;
use andahrm\setting\models\WidgetSettings;
use andahrm\insignia\models\InsigniaType;
use kartik\select2\Select2;
use andahrm\person\models\Person;
?>
<div class="edoc-insignia-update">

    <?php
    if ($formAction !== null)
        $formOptions['action'] = $formAction;

    //$formOptions['enableAjaxValidation'] = true;
    $formAction = str_replace('assign', 'assign-validate', $formAction);
    $formOptions['validationUrl'] = $formAction;
    ?>
    <?php $form = ActiveForm::begin($formOptions); ?>


    <div class="row">
        <div class="col-sm-5">   
            <?php
            echo $form->field($model, 'user_id')->widget(Select2::className(), [
                'data' => Person::getList(),
                'options' => ['placeholder' => Yii::t('andahrm/person', 'Search for a edoc')],
                'pluginOptions' => [
                    //'tags' => true,
                    //'tokenSeparators' => [',', ' '],
                    'allowClear' => true,
                    'minimumInputLength' => 2, //ต้องพิมพ์อย่างน้อย 3 อักษร ajax จึงจะทำงาน
                    'ajax' => [
                        'url' => Url::to(['/person/default/get-list']),
                        'dataType' => 'json', //รูปแบบการอ่านคือ json
                        'data' => new JsExpression('function(params) { return {q:params.term};}')
                    ],
                    'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                    'templateResult' => new JsExpression('function(position) { return position.text; }'),
                    'templateSelection' => new JsExpression('function (position) { return position.text; }'),
                ],
                    ]
            );
            ?>
        </div>

        <div class="col-sm-5">   

            <?php echo $form->field($model, 'insignia_type_id', ['enableAjaxValidation' => true])->dropDownList(InsigniaType::getList()); ?>
        </div>

        <div class="col-sm-2" >
            <div class="form-group" >
                <label class="control-label">&nbsp;</label>
                <?= Html::submitButton(Yii::t('andahrm/insignia', 'Add'), ['class' => 'btn btn-success form-control']) ?>
            </div>
        </div>
    </div>






    <?php ActiveForm::end(); ?>

</div>

<?php
///Surakit
if ($formAction !== null) {
    $js[] = <<< JS
$(document).on('submit', '#{$form->id}', function(e){
  e.preventDefault();
  var form = $(this);
  var formData = new FormData(form[0]);
  // alert(form.serialize());
  
  $.ajax({
    url: form.attr('action'),
    type : 'POST',
    data: formData,
    contentType:false,
    cache: false,
    processData:false,
    dataType: "json",
    success: function(data) {
      if(data.success){
        console.log(data);
        $.pjax.reload({container:"#pjax-person"});
      }else{
        alert('Fail');
      }
    }
  });
});
JS;

    $this->registerJs(implode("\n", $js));
}
?>

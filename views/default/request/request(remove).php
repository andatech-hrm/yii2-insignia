<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

use backend\widgets\WizardMenu;
use andahrm\insignia\models\InsigniaType;
use andahrm\insignia\models\InsigniaRequest;
use andahrm\structure\models\Position;
use andahrm\structure\models\PersonType;
use andahrm\structure\models\PositionLine;
use andahrm\structure\models\PositionLevel;
use andahrm\structure\models\FiscalYear;


use kartik\widgets\Typeahead;
use kartik\widgets\DepDrop;
use kartik\widgets\Select2;
/* @var $this yii\web\View */
/* @var $model andahrm\insignia\models\InsigniaRequest */
/* @var $form yii\widgets\ActiveForm */

//$session = Yii::$app->session;

// echo "<pre>";
// print_r($event);
// echo "</pre>";

// destroys all data registered to a session.
//$session->destroy();
// Yii::$app->cache->flush();
$this->title = Yii::t('andahrm/insignia', 'Create Insignia Request');
$this->params['breadcrumbs'][] = ['label' => Yii::t('andahrm/insignia', 'Insignia Requests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


$css = <<< Css
.person_type{
    display:none;
}
Css;
$this->registerCss($css);
?>

<?php echo WizardMenu::widget([
      'currentStepCssClass' => 'selected',
      'step' => $event->step,
      'wizard' => $event->sender,
      'options' => ['class'=>'wizard_steps anchor']
    ]);?>



<?php $form = ActiveForm::begin(['options'=>['data-pjax' => '']]); ?>

<div class="x_panel tile">
    <div class="x_title">
        <h2><?= $this->title; ?></h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        
        
        <?php /*=$this->render('button',['event'=>$event]);*/?>
        
        
      
            
            
            <div class="row">
                <div class="col-sm-4">
                    <?= $form->field($model, 'person_type_id')->dropDownList(PersonType::getForInsignia(),[
                    'prompt'=>Yii::t('app','Select'),
                    //'id'=>'ddl-person_type'
                    ]) ?>
                </div>
            
                <div class="col-sm-4 person_type type1" >
                    <?= $form->field($model, 'position_level_id')->widget(DepDrop::classname(), [
                        //'options'=>['id'=>'request-person_type_id'],
                        'data'=> PositionLevel::getListByPersonType($model->person_type_id),
                        'type'=>DepDrop::TYPE_SELECT2,
                        'pluginOptions'=>[
                            'depends'=>['request-person_type_id'],
                            'placeholder'=>Yii::t('app','Select'),
                            'url'=>Url::to(['get-position-level'])
                        ]
                    ]); ?>
                </div>
                
                
                <div class="col-sm-4 person_type type8" >
                    <?= $form->field($model, 'position_id')->widget(DepDrop::classname(), [
                        //'options'=>['id'=>'request-person_type_id'],
                        'data'=> Position::getListByPersonType($model->person_type_id),
                        'pluginOptions'=>[
                            'depends'=>['request-person_type_id'],
                            'placeholder'=>Yii::t('app','Select'),
                            'url'=>Url::to(['get-position'])
                        ]
                    ]); ?>
                </div>
                
                <div class="col-sm-4 person_type type9" >
                    <?= $form->field($model, 'position_line_id')->widget(DepDrop::classname(), [
                        //'options'=>['id'=>'request-person_type_id'],
                        'data'=> PositionLine::getListByPersonType($model->person_type_id),
                        'pluginOptions'=>[
                            'depends'=>['request-person_type_id'],
                            'placeholder'=>Yii::t('app','Select'),
                            'url'=>Url::to(['get-position-line'])
                        ]
                    ]); ?>
                </div>
                
                
            
            </div>
                
                
            <div class="row">
                <div class="col-sm-4">
                <?= $form->field($model, 'year')->dropDownList(FiscalYear::getList(),['prompt'=>Yii::t('app','Select')]) ?>
               </div>
               
                <div class="col-sm-4">
                <?= $form->field($model, 'insignia_type_id')->dropDownList(InsigniaType::getList(),['prompt'=>Yii::t('app','Select')]) ?>
                </div>
                
                <div class="col-sm-4">
                <?= $form->field($model, 'gender')->dropDownList(InsigniaType::getgender(),['prompt'=>Yii::t('app','Select')]) ?>
                </div>
            </div>      
                
                
            <div class="row">
                <div class="col-sm-4">
                <?= $form->field($model, 'certificate_offer_name')->widget(Typeahead::classname(),[
                  'options' => ['placeholder' => Yii::t('andahrm/insignia', 'Please type or select bondsman name')],
                  'pluginOptions' => ['highlight'=>true],
                  'defaultSuggestions' => InsigniaRequest::getListCertificator(), 
                  'dataset'=> [
                        [
                            'local' =>InsigniaRequest::getListCertificator(),
                            'limit' => 10
                        ]
                    ]
                  
                  ])?>
            
                <?php /* = $form->field($model, 'certificate_offer_date')->textInput() ?>
            
                <?php echo $form->field($model, 'edoc_id')->textInput() */?>
                </div>
            </div>
            
            
           
            
            
            
            <hr />
            <?=$this->render('button',['event'=>$event]);?>

        <div class="clearfix"></div>
    </div>
</div>
<?php ActiveForm::end(); ?>


<?php 

$js = <<< Js
    $('.person_type').hide();
    var select = $('#request-person_type_id option:selected').val();
    $('.person_type.type'+select).show();
    $('#request-person_type_id').change(function(){
        var selected = $(this).find('option:selected').val();
        $('.person_type').hide();
         //$('.person_type > select').attr('disabled',true);
        $('.person_type.type'+selected).show();
        //$('.person_type.type'+selected+' > select').attr('disabled',false);
        console.log('.person_type.type'+selected);
    });


Js;


$this->registerJs($js);

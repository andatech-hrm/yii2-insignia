<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use backend\widgets\WizardMenu;
use andahrm\insignia\models\InsigniaType;
use andahrm\insignia\models\InsigniaRequest;
use andahrm\structure\models\PersonType;
use andahrm\structure\models\FiscalYear;

use andahrm\insignia\models\Assign;

use kartik\widgets\Typeahead;
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


$stepTopic = $event->sender->read('topic')[0];
$stepPerson = $event->sender->read('person')[0];
$stepAssign = $event->sender->read('assign')[0];

//print_r($stepAssign);
?>

<?php echo WizardMenu::widget([
      'currentStepCssClass' => 'selected',
      'step' => $event->step,
      'wizard' => $event->sender,
      'options' => ['class'=>'wizard_steps anchor']
    ]);?>
    

<?php $form = ActiveForm::begin(); ?>
<?=$form->field($model,'status')->textInput()?>
<div class="x_panel tile">
    <div class="x_title">
        <h2><?= $this->title; ?></h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
    
        
        
             <?=$this->render('../_template_gov',[
             //'event'=>$event,
             //'model'=>$model
             'person_type' => $stepTopic->personType->title,
             'year' => $stepTopic->yearTh,
             'person' => Assign::getPerson($stepPerson)->getModels(),
             'assign' => $stepAssign
             ]);?>
         
        
            <hr />
            <?=$this->render('button',['event'=>$event]);?>
            
            

        <div class="clearfix"></div>
    </div>
</div>
<?php ActiveForm::end(); ?>




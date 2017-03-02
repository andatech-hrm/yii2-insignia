<?php

//use yii\helpers\Html;
use yii\bootstrap\Html;
use yii\widgets\ActiveForm;

use backend\widgets\WizardMenu;
use andahrm\insignia\models\Assign;
use andahrm\insignia\models\InsigniaType;

 
 
use kartik\widgets\Select2;


//print_r($person);
 
//print_r($event);
//echo "</pre>";
//echo $ss->insignia_type_id;


// echo "<pre>";
// print_r($event);
// echo "</pre>";
$this->title = Yii::t('andahrm/insignia', 'Create Insignia Request');
$this->params['breadcrumbs'][] = ['label' => Yii::t('andahrm/insignia', 'Insignia Requests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$data = $model;
?>

<?php echo WizardMenu::widget([
      'currentStepCssClass' => 'selected',
      'step' => $event->step,
      'wizard' => $event->sender,
      'options' => ['class'=>'wizard_steps anchor']
    ]);?>


<?php $form = ActiveForm::begin(); ?>


<div class="x_panel tile">
    <div class="x_title">
        <h2><?= Yii::t('andahrm/insignia', 'Select Persons'); ?></h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        
        <?php
        echo yii\grid\GridView::widget([
            'dataProvider' => Assign::getPerson($event->sender->read('person')[0]),
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute'=>'user_id',
                    //'format'=>'html',
                    'value'=>'user.fullname',
                ],
                 [
                    'attribute'=>'step',
                    'content'=> function($model){
                        return $model->step
                        .Html::hiddenInput("Assign[current_step][{$model->user_id}]",
                            $model->step
                            );
                    },
                ],
                 [
                    'attribute'=>'adjust_date',
                    'content'=> function($model){
                        return Yii::$app->formatter->asDate($model->adjust_date)
                        .Html::hiddenInput("Assign[current_adjust_date][{$model->user_id}]",
                            $model->adjust_date
                            );
                    },
                    ],
                    
                  [
                    'attribute'=>'salary',
                    'format' => 'decimal',
                    'contentOptions'=>['class'=>'text-right'],
                    'content'=> function($model){
                        return Yii::$app->formatter->asDecimal($model->salary)
                        .Html::hiddenInput("Assign[current_salary][{$model->user_id}]",
                            $model->salary
                            );
                    },
                ],
                [
                    'attribute'=>'position_id',
                    'format'=>'html',
                    'content'=> function($model){
                        return $model->position->title."<br/><small>".$model->position->code."</small>"
                        .Html::hiddenInput("Assign[current_position_id][{$model->user_id}]",
                            $model->position_id
                            );
                    },
                ],
                [
                    'attribute'=>'insignia_request_id',
                    'format' => 'html',
                    'value'=>'insigniaType.title',
                    'content'=> function($model){
                        return $model->insignia_type_id?$model->insigniaType->title
                        .Html::hiddenInput("Assign[current_insignia_request_id][{$model->user_id}]",
                            $model->insignia_request_id
                            ):'-';
                    },
                ],
                
                [
                    'attribute'=>'insignia_type_id',
                    'format'=>'html',
                    'content'=> function($model) use ($data){
                        return Select2::widget([
                            'name'=>"Assign[insignia_type_id][{$model->user_id}]",
                            'data'=>InsigniaType::getList(),
                            'value'=>$data->insignia_type_id[$model->user_id]
                            ]);
                    },
                ],
                [
                    'attribute'=>'note',
                    'format'=>'html',
                    'content'=> function($model) use ($data){
                        return 
                        Html::beginTag('div',['form-group'])
                        .Html::textInput("Assign[note][{$model->user_id}]",
                            $data->note[$model->user_id],
                            ['class'=>'form-control']
                            )
                        .Html::endTag('div');
                    },
                ],
            ]
        ]);
        ?>
    
        
        
    
    <?php /*= $this->render('button',['event'=>$event]);*/?>

    <?php /*= $form->field($model, 'insignia_request_id')->textInput()?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'position_level_id')->textInput() ?>

    <?= $form->field($model, 'position_current_date')->textInput() ?>

    <?= $form->field($model, 'salary')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'position_id')->textInput() ?>

    <?= $form->field($model, 'insignia_request_id_last')->textInput() ?>

    <?= $form->field($model, 'insignia_type_id')->textInput() ?>

    <?= $form->field($model, 'feat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'note')->textInput(['maxlength' => true])  */?>

     <?=$this->render('button',['event'=>$event]);?>
     
     

        <div class="clearfix"></div>
    </div>
</div>
<?php ActiveForm::end(); ?>
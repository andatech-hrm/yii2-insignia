<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use backend\widgets\WizardMenu;
use andahrm\insignia\models\Detail;



//print_r($person);
 
//print_r($event);
//echo "</pre>";
//echo $ss->insignia_type_id;


// echo "<pre>";
// print_r($event);
// echo "</pre>";
$this->title = Yii::t('andahrm/insignia', 'Create Insignia Request');
$this->params['breadcrumbs'][] = ['label' => Yii::t('andahrm/insignia', 'Insignia Requests'), 'url' => ['index']];

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
        $selection = $model; #Global
        echo yii\grid\GridView::widget([
            'dataProvider' => Detail::getPerson($event),
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'class' => 'yii\grid\CheckboxColumn',
                    'name' => 'Person[selection][]',
                    'checkboxOptions' => function ($model, $key, $index, $column) use ($selection) {
                        $checked =  $selection->selection&&in_array($model->user_id,$selection->selection)?'checked':null;
                        return [
                            'value' => $model->user_id,
                            'checked' => $checked,
                        ];
                     }
                ],
                [
                    'attribute'=>'user_id',
                    'value'=>'user.fullname',
                ],
                [
                    'attribute'=>'position_id',
                    'value'=> 'position.title',
                ],
                'salary'
            ]
        ]);
        ?>
    
        
     <?=$this->render('button',['event'=>$event]);?>
     
     

        <div class="clearfix"></div>
    </div>
</div>
<?php ActiveForm::end(); ?>
<?php
use yii\helpers\Html;


$step = $event->step;
$finish= $event->sender->getStepCount()-1;
$steps= $event->sender->getSteps();
$step_index = array_search($step,$steps);
?>


<div class="row">
    <div class="col-sm-12">
<?php

echo Html::beginTag('div', ['class' => 'btn-toolbar','role'=>'toolbar']);

    echo Html::beginTag('div', ['class' => 'btn-group pull-left','role'=>'group']);
         echo Html::a('<i class="fa fa-times"></i> Reset',['request','step'=>'reset'], ['class' => 'btn btn-link', 'name' => 'cancel', 'value' => 'pause']);
     echo Html::endTag('div');
    
    
     echo Html::beginTag('div', ['class' => 'btn-group pull-right','role'=>'group']);
         if($step_index >0){
            echo Html::submitButton('<i class="fa fa-pause"></i>  Pause', ['class' => 'btn btn-default', 'name' => 'pause', 'value' => 'pause']);
         }
         echo Html::submitButton('<i class="fa fa-times"></i> Cancel', ['class' => 'btn btn-default', 'name' => 'cancel', 'value' => 'pause']);
     echo Html::endTag('div');
    
    
    echo Html::beginTag('div', ['class' => 'btn-group pull-right','role'=>'group']);
        //if($event->n >0 && $event->t ==1 ){
            echo Html::submitButton('<i class="fa fa-arrow-left "></i> Prev', ['class' => 'btn btn-primary', 'name' => 'prev', 'value' => 'prev' ]);
       // }else{
       //     echo Html::submitButton('<i class="fa fa-arrow-left "></i> Prev', ['class' => 'btn btn-default', 'name' => 'prev', 'value' => 'prev','disabled'=>'disabled' ]);
       // }
        
        if($finish>$step_index){
            echo Html::submitButton('Next <i class="fa fa-arrow-right "></i>', ['class' => 'btn btn-success', 'name' => 'next', 'value' => 'next']);
        }else{
            echo Html::submitButton('<i class="fa fa-flag-checkered"></i> Done', ['class' => 'btn btn-success', 'name' => 'next', 'value' => 'next','onclick'=>'if(confirm("Are you"))']);
        }
    echo Html::endTag('div');
    
    
    
echo Html::endTag('div');
?>

</div>
</div>

<?php
//echo $event->sender;


// echo "<pre>";
// // print_r($event->sender-wizard->steps);
// // print_r($event->sender->getStepCount());
// echo $event->n."<br/>";
// echo $event->t."<br/>";
// echo $event->nextStep."<br/>";
// echo $event->continue."<br/>";
// echo "</pre>";
// ?>
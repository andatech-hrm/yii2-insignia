<?php
use yii\helpers\Html;
use andahrm\person\models\Person;
use andahrm\insignia\models\InsigniaType;
use andahrm\insignia\models\InsigniaPerson;


$css = <<< Css
@media print{@page {size: landscape}}
Css;

$this->registerCss($css);



$tambol = isset($tambol)?$tambol:'';
$amphur = isset($amphur)?$amphur:'';
$provence = isset($provence)?$provence:'';
$level = isset($level)?$level:'';
?>


<div class="row">
    <div class="col-sm-12">
       <?=Html::tag('h4',
           Yii::t('andahrm/insignia','topic {person_type} {year}',['person_type'=>$person_type,'year'=>$year]),
           ['class'=>'text-center']
       )?>
    
        <?=Html::tag('h4',
           Yii::t('andahrm/insignia','Administrative Organization {tambol} {amphur} {provence}',['tambol'=>$tambol,'amphur'=>$amphur,'provence'=>$provence]),
           ['class'=>'text-center']
       )?>
       
       <?=Html::tag('h4',
        Yii::t('andahrm/insignia','Level {levle}',['levle'=>$topic->insignia_type_id?$topic->insigniaType->title:'',]),['class'=>'text-center']
       )?>

    </div>
    
</div>



<div class="row">
    <div class="col-sm-12">
        <br/>
        <table class="table table-bordered" width="100%">
            <thead>
                <tr>
                    <th rowspan="2"><?=Yii::t('andahrm/insignia', 'No')?></th>
                    <th rowspan="2"><?=(new Person)->getAttributeLabel('fullname')?></th>
                    <th colspan="3"><?=Yii::t('andahrm/insignia', 'To be goverment')?>เป็นข้าราชการ</th>
                    <th ><?=Yii::t('andahrm/insignia', 'Position')?></th>
                    <th rowspan="2"><?=Yii::t('andahrm/insignia', 'List insignia type')?></th>
                    <th rowspan="2"><?=Yii::t('andahrm/insignia', 'day month year')?> ปี</th>
                    <th rowspan="2"><?=Yii::t('andahrm/insignia', 'This request')?>ขอครั้งนี้</th>
                    <th ><?=Yii::t('andahrm/insignia', 'Note')?></th>
                </tr>
                
                <tr>
                    <th><?=Yii::t('andahrm/insignia', 'No')?></th>
                    <th><?=Yii::t('andahrm/insignia', 'day month year')?></th>
                    <th><?=Yii::t('andahrm/insignia', 'Salary')?></th>
                    <th><?=Yii::t('andahrm/insignia', 'Current and former')?>ปัจจุบัน</th>
                    <th></th>
                </tr>
                
                
            </thead>
            
            <tbody>
                <?php 
                //print_r($person);
                
                foreach ($person as $key=>$model):
                $last = InsigniaPerson::getInsigniaTypes($model->user_id);
                //print_r($last);
                ?>
                <tr>
                    <td><?=$key+1?></td>
                    <td><?=$model->user->fullname?></td>
                    <td><?=$model->step?></td>
                    <td><?=$model->adjust_date?></td>
                    <td><?=Yii::$app->formatter->asDecimal($model->salary)?></td>
                    <td><?=$model->position->title?></td>
                    
                    <td><?=$last?$last->insigniaType->title:null?></td>
                    <td><?=$last?Yii::$app->formatter->asDate($last->insigniaRequest->created_at):null?></td>
                    <td><?=InsigniaType::getItem($assign->insignia_type_id[$model->user_id])->title?></td>
                    <td><?=$assign->note[$model->user_id]?></td>
                </tr>
                 <?php endforeach;?>
            </tbody>
        </table>
        
    </div>
</div>


<div class="row">
    <div class="col-sm-10 col-sm-offset-2">
        <?=Html::tag('h5', Yii::t('andahrm/insignia','Certifies that {year} {point}',['year'=> 2536,'point'=> '8,10,39(3),22']))?>
        
        
    </div>
</div>

<div class="row">
    <div class="col-sm-4 col-sm-offset-7">
        <p class="text-left">
		    (<?=Yii::t('andahrm','sign')?>) 
		    <span class="text-dashed width80">
		    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		    </span>
	    </p>
        <p class="text-left">
    	    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    	    (<span class="text-dashed width80 text-center"><?=$topic->certificate_offer_name?></span>)
	    </p>
	    
	    <p class="text-left">
	        <?=Yii::t('andahrm/structure','Positions')?> <?=Yii::t('andahrm/insignia','Governor')?>
	    </p>
	    
	    <p class="text-left">
    	    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    	    <?=Yii::t('andahrm/insignia', 'The certification offered clemency')?>
	    </p>
        
    </div>
</div>
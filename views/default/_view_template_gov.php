<?php
use yii\helpers\Html;
use andahrm\person\models\Person;
use andahrm\insignia\models\InsigniaType;
use andahrm\insignia\models\InsigniaPerson;

use yii\helpers\ArrayHelper;
use andahrm\setting\models\Helper;



$tambol = isset($tambol)?$tambol:'';
$amphur = isset($amphur)?$amphur:'';
$provence = isset($provence)?$provence:'';


$css = <<< Css
@media print{@page {size: landscape}}
Css;

$this->registerCss($css);

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
        Yii::t('andahrm/insignia','Level {insigniaType} {gender}',['insigniaType'=>$insigniaType,'gender'=>$gender]),['class'=>'text-center']
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
                    <td><?=$model->last_step?></td>
                    <td><?=Yii::$app->formatter->asDate($model->last_adjust_date)?></td>
                    <td><?=Yii::$app->formatter->asDecimal($model->last_salary)?></td>
                    <td><?=$model->lastPosition->title?></td>
                    
                    <td><?=$last->lastInsigniaType?$last->lastInsigniaType->title:null?></td>
                    <td><?=$last->lastInsigniaType?Yii::$app->formatter->asDate($last->lastInsigniaRequest->created_at):null?></td>
                    <td><?=$model->insigniaType->title?></td>
                    <td><?=$model->note?></td>
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
    	    (<span class="text-dashed width80">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>)
	    </p>
	    
	    <p class="text-left">
	        <?=Yii::t('andahrm/structure','Positions')?> <?=Yii::t('andahrm/insignia','Governor')?>
	    </p>
	    
	    <p class="text-left">
	        <?=Yii::t('andahrm/insignia', 'Certification on')?> 
	       <?php
	       // $cer_date = \DateTime::createFromFormat(Helper::UI_DATE_FORMAT, $modelRequest->certificate_offer_date);
	       // $modelRequest->certificate_offer_date = $cer_date->format(Helper::DB_DATE_FORMAT);
	       if (isset($modelRequest->certificate_offer_date) && \DateTime::createFromFormat(Helper::DB_DATE_FORMAT, $modelRequest->certificate_offer_date) !== false) {
            echo Yii::$app->formatter->asDate($modelRequest->certificate_offer_date);
	       }else{
	           echo '<span class="not-set">'.Yii::t('yii', '(not set)').'</span>';
	       }
	        ?>
	    </p>
	    
	    <p class="text-left">
    	    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    	    <?=Yii::t('andahrm/insignia', 'The certification offered clemency')?>
	    </p>
        
    </div>
</div>
<?php
use yii\helpers\Html;
use andahrm\person\models\Person;



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
        Yii::t('andahrm/insignia','Level {levle}',['levle'=>$levle,]),['class'=>'text-center']
       )?>

    </div>
    
</div>



<div class="row">
    <div class="col-sm-12">
        <br/>
        <table class="table table-bordered" width="100%">
            <thead>
                <tr>
                    <th rowspan="2">ลำดับ</th>
                    <th rowspan="2"><?=(new Person)->getAttributeLabel('fullname')?></th>
                    <th colspan="3">เป็นข้าราชการ</th>
                    <th >ตำแหน่ง</th>
                    <th rowspan="2">ลำดับเครื่องราช</th>
                    <th rowspan="2">วัน เดือน ปี</th>
                    <th rowspan="2">ขอครั้งนี้</th>
                    <th >หมายเหตุ</th>
                </tr>
                
                <tr>
                    <th>ระดับ</th>
                    <th>วันเดือนปี</th>
                    <th>เงินเดือน</th>
                    <th>ปัจจุบัน</th>
                    <th></th>
                </tr>
                
                
            </thead>
            
            <tbody>
                <?php 
                //print_r($person);
                
                foreach ($person as $key=>$model):?>
                <tr>
                    <td><?=$key+1?></td>
                    <td><?=$model->user->fullname?></td>
                    <td><?=$model->level?></td>
                    <td><?=$model->adjust_date?></td>
                    <td><?=$model->salary?></td>
                    <td><?=$model->position->title?></td>
                    <td></td>
                    <td></td>
                    <td><?=$assign->insignia_type_id[$model->user_id]?></td>
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
    	    (<span class="text-dashed width80">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>)
	    </p>
	    
	    <p class="text-left">
	        <?=Yii::t('andahrm/structure','Positions')?> <?=Yii::t('andahrm/insignia','Governor')?>
	    </p>
	    
	    <p class="text-left">
    	    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    	    <?=Yii::t('andahrm/insignia', 'ผู้รับรองเสนอขอพระราชทาน')?>
	    </p>
        
    </div>
</div>
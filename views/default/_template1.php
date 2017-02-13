<?php
use yii\helpers\Html;



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
        
        <table class="table table-bordered">
            <thead>
                <tr>
                <th>#</th>
                </tr>
            </thead>
            
            <tbody>
                <tr>
                    <td>
                        
                    </td>
                </tr>
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
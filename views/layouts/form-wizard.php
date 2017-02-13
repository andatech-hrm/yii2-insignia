<?php
use andahrm\leave\WizardMenu;

 $this->beginContent('@andahrm/views/layouts/main.php'); 
 
 
 ?>
 
 <?php echo WizardMenu::widget([
      'currentStepCssClass' => 'selected',
      'step' => $event->step,
      'wizard' => $event->sender,
      'options' => ['class'=>'wizard_steps anchor']
    ]);?>
    
    
    <?php echo $content; ?>
             

<?php $this->endContent(); ?>
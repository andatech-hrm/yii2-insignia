<?php
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\web\Jgenderpression;
use anda\core\widgets\cropimageupload\CropImageUpload;
?>
<div class="form-group-image-crop">
    <div style="width:100px;height:100px;overflow:hidden;margin-left:5px;">
    <?= Html::img($model->getUploadUrl('marker'), ['class' => 'img-responsive img-cropped-preview', 'id' => 'preview']); ?>
    </div>

    <?php
    $modal = Modal::begin([
        'header' => Html::tag('h2', 'Upload marker'),
        'toggleButton' => ['label' => 'เลือกรูป','class'=>'btn '],
        'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">'.Yii::t('app','Done').'</a>',
        'options' => [
            
            'class' => 'modal-cropimage fade'
        ]
    ]);
    ?>
    <?= $form->field($model, 'marker')->widget(CropImageUpload::className()); ?>
    <?php Modal::end(); ?>
</div>



<?php
$inputImageCrop = Html::getInputId($model, 'marker_scope'); 
?>
<?php
$js[] = <<< JS
$('.modal-cropimage').on('hidden.bs.modal', function (e) {
    var img_crop = $(this).find('.crop-image-upload-container>img');
    var img_preview = $('#preview');
    img_preview.attr('src', img_crop.prop('src'));
});

JS;

$this->registerJs(implode("\n", $js));
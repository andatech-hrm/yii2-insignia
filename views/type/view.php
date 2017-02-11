<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model andahrm\insignia\models\InsigniaType */

$this->title = $model->title.($model->title_full?' ('.$model->title_full.')':'');
$this->params['breadcrumbs'][] = ['label' => Yii::t('andahrm/insignia', 'Insignia Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="insignia-type-view">

    <h1><?= Html::img($model->getUploadUrl('marker'), ['width'=>'100']);?> <?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('andahrm/insignia', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('andahrm/insignia', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('andahrm/insignia', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'title_full',
            'status',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
        ],
    ]) ?>

</div>

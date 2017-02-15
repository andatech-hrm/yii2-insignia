<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Registration Wizard Complete';

//echo $event->sender->menu->run();


// echo Html::beginTag('div', ['class' => 'section']);
// echo Html::tag('h2', 'Profile');
// echo DetailView::widget([
//     'model' => $data['request'][0],
//     'attributes' => [
//         'id', 'person_type_id', 'insignia_type_id', 'gender', 'status', 'edoc_id', 'created_at', 'created_by', 'updated_at', 'updated_by'
//     ]
// ]);
// echo Html::endTag('div');

// echo Html::beginTag('div', ['class' => 'section']);
// echo Html::tag('h2', 'Address');
// echo DetailView::widget([
//     'model' => $data['detail'][0],
//     'attributes' => [
//         'insignia_request_id', 'user_id', 'position_level_id', 'position_id', 'insignia_request_id_last', 'insignia_type_id'
//     ]
// ]);
// echo Html::endTag('div');


// echo Html::a('Choose Another Demo', '/wizard');
?>


<?=Html::tag('h1','Success')?>
<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Registration Wizard Paused';

echo Html::tag('h1', $this->title);
echo Html::tag('div', strtr('Go to the following URL to resume your registration: {url}', ['{url}' => Html::a(Url::to(['default/resume', 'uuid' => $uuid], true), ['default/resume', 'uuid' => $uuid])]));
//echo Html::a('Choose Another Demo', '/wizard');

<?php

namespace andahrm\insignia;

/**
 * insignia module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'andahrm\insignia\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
         $this->layout = 'main';
        parent::init();

        // custom initialization code goes here
    }
}

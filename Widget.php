<?php
namespace yii\dwz;

/**
* 
*/
class Widget extends \yii\base\Widget
{
	public $options = [];

	public function init(){
		parent::init();
		if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }
	}
}
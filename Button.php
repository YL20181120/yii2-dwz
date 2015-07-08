<?php

namespace yii\dwz;
use yii\helpers\Html;
use \yii\base\InvalidParamException;
/**
* 
*/
class Button extends Widget
{
	public $content;

	public $buttonOptions = [];
	public $type = 'button';

	const _TYPE = ['button','active','disabled'];
	public function init(){
		if(!in_array($this->type, self::_TYPE))
			throw new InvalidParamException("Param type must in range '".implode(' ', self::_TYPE)."'",1);
	}
	public function run(){
		switch ($this->type) {
			case 'active':
				$this->options['class'] = 'buttonActive';
				break;
			case 'disabled':
				$this->options['class'] = 'buttonDisabled';
				break;			
			default:
				$this->options['class'] = 'button';
				break;
		}
		return Html::tag('div',Html::tag('div',
			Html::tag('button',$this->content,$this->buttonOptions)
			,['class'=>'buttonContent']),$this->options);
	}

}
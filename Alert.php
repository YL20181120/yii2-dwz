<?php

namespace yii\dwz;
use yii\helpers\Html;
use \yii\base\InvalidParamException;
/**
* 
*/
class Alert extends Widget
{
	public $message;

	public $type = 'info';

	public $content;

	const CLASS_RANGE = ['info','warning','success','error','javascript'];
	public function init(){
		if(!in_array($this->type, self::CLASS_RANGE))
			throw new InvalidParamException("Param type must in range '".implode(' ', self::CLASS_RANGE)."'",1);
		if($this->content == null || $this->content == "")
			throw new InvalidParamException("content can not be null",1);
	}
	public function run(){
		return $this->renderAlert();
	}

	protected function renderAlert() {
		switch ($this->type) {
			case 'warning':
				$this->options['onclick'] = "alertMsg.warn('".$this->message."')";
				break;
			case 'success':
				$this->options['onclick'] = "alertMsg.correct('".$this->message."')";
				break;
			case 'error':
				$this->options['onclick'] = "alertMsg.error('".$this->message."')";
				break;
			case 'javascript':
				$this->options['onclick'] = $this->message;
				break;								
			case 'info':
				$this->options['onclick'] = "alertMsg.info('".$this->message."')";
				break;
		}
		return Html::a($this->content,'javascript:;',$this->options);;
	}
}
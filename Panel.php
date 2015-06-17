<?php

namespace yii\dwz;
use yii\helpers\Html;
use yii\base\InvalidCallException;

class Panel extends Widget
{
	public $title;
	public function init(){
		parent::init();
		if(!isset($this->title) || $this->title == '')
			throw new InvalidCallException("Title is not allowed null or ''");
			
		if(!isset($this->options['class']))
			$this->options['class'] = 'panel';
		echo Html::beginTag('div',$this->options).
			 Html::tag('h1',$this->title).
			 Html::beginTag('div');
	}
	public function run(){
		return Html::endTag('div').Html::endTag('div');
	}
}
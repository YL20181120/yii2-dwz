<?php

namespace yii\dwz;
use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\Html;
/**
* 
*/
class Dialog extends Widget
{
	public $width = '600';
	public $height = '300';
	public $rel		= null;
	public $title	= null;
	public $text	= null;
	public $url		= null;
	public function init(){
		if($this->title == null || $this->rel == null || $this->text == null || $this->url == null) {
			throw new InvalidConfigException("Config can not be null");
		}
		$this->options = [
			'target'=> 'dialog',
			'rel' 	=> $this->rel,
			'title' => $this->title,
			'width' => $this->width,
			'height'=> $this->height,
		];
	}
	public function run(){
		return Html::a($this->text,$this->url,$this->options);
	}
}
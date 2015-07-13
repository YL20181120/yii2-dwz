<?php

namespace yii\dwz;
use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
/**
* 
*/
class Dialog extends Widget
{
	public $width = '600';
	public $height = '300';
	public $mask	= 'false';
	public $rel		= null;
	public $title	= null;
	public $text	= null;
	public $url		= null;
/*	
	以下配置可以卸载options中
	minable:	dialog 是否可最小化,
	mixable:	dialog 是否可最大化
	resizable: dialog 是否可变大小
	drawable: dialog 是否可拖动
	width:	dialog 打开时的默认宽度
	height:	dialog 打开时默认的高度
	width,height分别打开dialog时的宽度与高度.
	fresh:	重复打开dialog时是否重新载入数据,默认值true,
	close:	关闭dialog时的监听函数,需要有boolean类型的返回值,
	param:	close监听函数的参数列表,以json格式表示,例{msg:’message’}*/
	public function init(){
		if($this->title == null || $this->rel == null || $this->text == null || $this->url == null) {
			throw new InvalidConfigException("Config can not be null");
		}
		$this->options = ArrayHelper::merge($this->options,[
			'target'=> 'dialog',
			'rel' 	=> $this->rel,
			'title' => $this->title,
			'width' => $this->width,
			'height'=> $this->height,
			'mask'	=> $this->mask,
		]);
	}
	public function run(){
		return Html::a($this->text,$this->url,$this->options);
	}
}
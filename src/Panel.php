<?php
/**
 * Created by Jasmine2.
 * FileName: Pannel.php
 * Date: 2016-4-25
 * Time: 10:54
 */

namespace jasmine2\dwz;



use jasmine2\dwz\helpers\ArrayHelper;
use jasmine2\dwz\helpers\Html;

class Panel extends Widget
{
	//标题
	public $title;
	//可关闭
	public $close = false;
	// 可折叠
	public $collapse = false;


	public $footer;
	public function init()
	{
		parent::init();
		Html::addCssClass($this->options,'panel');
		//close 会有BUG
		/*if($this->close)
			Html::addCssClass($this->options,'close');*/
		if($this->collapse)
			Html::addCssClass($this->options,'collapse');
	}


	public function beginPanel(){
		echo Html::beginTag('div',$this->options);
		echo Html::tag('h1',$this->title);
		echo Html::beginTag('div');
	}

	public function endPanel(){
		echo Html::endTag('div');
		echo Html::endTag('div');
	}
}
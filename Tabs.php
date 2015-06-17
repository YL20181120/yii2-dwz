<?php

namespace yii\dwz;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
/**
* 
*/
class Tabs extends Widget
{
	public $items;
	public $currentIndex = 0;
	public $eventType    = 'click';

	public $contentStyle = '';
	private $headers = [];
	private $contents = [];

	public function init(){
		parent::init();
		$this->options['class'] 	   = 'tabs';
		$this->options['currentIndex'] = $this->currentIndex;
		$this->options['eventType']    = $this->eventType;
		echo Html::beginTag('div',$this->options);
	}
	public function run(){
		echo $this->render();
		echo Html::tag('div',Html::tag('div','',['class' => 'tabsFooterContent']),['class' => 'tabsFooter']);
		echo Html::endTag('div');
	}

	public function render(){
		$this->renderItems();
		$tabs = '';
		echo Html::beginTag('div',['class'=>'tabsHeader']);
		echo Html::beginTag('div',['class'=>'tabsHeaderContent']);
		echo Html::beginTag('ul');
		echo implode('',$this->headers);
		echo Html::endTag('ul');
		echo Html::endTag('div');
		echo Html::endTag('div');
		echo Html::beginTag('div',['class'=>'tabsContent','style'=>$this->contentStyle]);
		echo implode('',$this->contents);
		echo Html::endTag('div');
	}
	protected function renderItems(){
		foreach ($this->items as $v) {
			$tab = new Tab($v);
			$this->headers[] = $this->renderHeader($tab->title,$tab->url);
			$this->contents[]= $this->renderContent($tab->content);
		}
	}

	protected function renderHeader($title,$url){
		if(empty($url))
			$url = 'javascript:;';
		else 
			$this->options['class'] = 'j-ajax';
		return Html::tag('li',Html::a(Html::tag('span',$title),$url,$this->options));
	}
	protected function renderContent($content){
		return Html::tag('div',$content);
	}
}
<?php
/**
 * Created by Jasmine2.
 * FileName: Tabs.php
 * Date: 2016-4-25
 * Time: 21:13
 */

namespace jasmine2\dwz;


use jasmine2\dwz\helpers\Html;
use jasmine2\dwz\Tab;
use yii\base\InvalidConfigException;

class Tabs extends Widget
{
	public $tabs         = [];
	public $items        = [];
	public $currentIndex = 0;
	public $eventType    = 'click';

	public $contentOptions = [];

	public function init()
	{
		parent::init();
		if(empty($this->items) || !is_array($this->items)){
			throw new InvalidConfigException("param `item` must be set");
		}
		foreach ($this->items as $item) {
			$this->tabs[] = new Tab($item);
		}
		$this->options['eventType'] = $this->eventType;
		$this->options['currentIndex'] = $this->currentIndex;
		Html::addCssClass($this->options, 'tabs');
		echo Html::beginTag('div',$this->options);
	}

	public function run()
	{
		$this->renderItems();
		echo Html::endTag('div');
	}

	private $contents = [];
	protected function addContents(Tab $tab){
		$this->contents[] = Html::tag('div',$tab->content);
	}
	private $headers = [];
	protected function addHeaders(Tab $tab){
		if(is_null($tab->url)){
			$this->headers[] = Html::tag('li',
				Html::a(Html::tag('span',$tab->title),'javascript:;')
			);
		} else {
			$this->headers[] = Html::tag('li',
				Html::a(Html::tag('span',$tab->title),$tab->url, [
					'class'=> 'j-ajax'
				])
			);
		}
	}

	protected function renderFooter(){
		echo Html::tag('div',Html::tag('div','',['class' => 'tabsFooterContent']),['class' => 'tabsFooter']);
	}

	protected function renderHeaders(){
		if($this->headers){
			echo Html::tag('div',Html::tag('div',Html::tag('ul',implode('',$this->headers)),['class' => 'tabsHeaderContent']),['class' => 'tabsHeader']);
		}
	}

	protected function renderContents(){
		if($this->contents){
			Html::addCssClass($this->contentOptions,'tabsContent');
			echo Html::tag('div',implode('',$this->contents),$this->contentOptions);
		}
	}

	protected function renderItems(){
		foreach ($this->tabs as $tab) {
			$this->addHeaders($tab);
			$this->addContents($tab);
		}
		$this->renderHeaders();
		$this->renderContents();
		$this->renderFooter();
	}
}
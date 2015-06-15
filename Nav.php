<?php

namespace yii\dwz;

use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class Nav extends Widget
{
	public $items = [];
	public $_items = [];

	public $params;

	public $route;
	public function init(){
		parent::init();
		if ($this->route === null && Yii::$app->controller !== null) {
            $this->route = Yii::$app->controller->getRoute();
        }
        if ($this->params === null) {
            $this->params = Yii::$app->request->getQueryParams();
        }
	}
	public function run(){
		DwzAsset::register($this->getView());
		$this->renderItems($this->items);
		//return Html::tag('div',$this->_items,['class'=>'accordion','fillSpace'=>'sidebar']);
		var_dump($this->_items);
	}

	public function renderItems($_items){
        foreach ($_items as $i => $item) {
        	//判断是否为叶子节点
            if (isset($item['visible']) && !$item['visible']) {
                continue;
            } elseif(isset($item['menus']) && count($item['menus'])){
            	$_t = $item['menus'];
            	unset($item['menus']);
            	$this->_items[] = $this->renderItem($item);
            	$this->renderItems($_t);
            	continue;
            }
            $this->_items[] = $this->renderItem($item);
        }
	}

	public function renderItem($item){
		if(!isset($item))
			return false;
		if(is_string($item)){
			return $item;
		}
		if(!isset($item['label'])){
			throw new InvalidConfigException("The 'label' option is required.");
		}
		return $item;
	}
	//普通顶结点
	protected function renderRoot($item){
		return Html::tag('div',Html::tag('h2',Html::tag('span','Folder').$item['label']));
	}
	//叶子节点
	protected function renderLeaf($item){
		return Html::tag('li',Html::a($item['label'],$item['url'],['target'=>'navTab']));
	}

	//中间节点,应该还有子节点
	protected function renderMiddle($item) {

	}
}
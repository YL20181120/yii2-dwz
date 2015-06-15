<?php

namespace yii\dwz;

use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class Nav extends Widget
{
	public $items = [];
	public $_items = '';

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
		//$this->renderItems($this->items);
		$this->_items = '<div class="accordionHeader">
						<h2><span>Folder</span>界面组件</h2>
					</div>
					<div class="accordionContent">
						<ul class="tree treeFolder">
							<li><a href="tabsPage.html" target="navTab">主框架面板</a>
								<ul>
									<li><a href="main.html" target="navTab" rel="main">我的主页</a></li>
								</ul>
							</li>
							
							<li><a>常用组件</a>
								<ul>
									<li><a href="w_panel.html" target="navTab" rel="w_panel">面板</a></li>
								</ul>
							</li>
							<li><a href="dwz.frag.xml" target="navTab" external="true">dwz.frag.xml</a></li>
						</ul>
					</div>
					<div class="accordionHeader">
						<h2><span>Folder</span>典型页面</h2>
					</div>
					<div class="accordionContent">
						<ul class="tree treeFolder treeCheck">
							<li><a href="demo_page1.html" target="navTab" rel="demo_page1">查询我的客户</a></li>
							<li><a href="demo_page1.html" target="navTab" rel="demo_page2">表单查询页面</a></li>
							<li><a href="demo_page4.html" target="navTab" rel="demo_page4">表单录入页面</a></li>
							<li><a href="demo_page5.html" target="navTab" rel="demo_page5">有文本输入的表单</a></li>
							<li><a href="javascript:;">有提示的表单输入页面</a>
								<ul>
									<li><a href="javascript:;">页面一</a></li>
									<li><a href="javascript:;">页面二</a></li>
								</ul>
							</li>
							<li><a href="javascript:;">选项卡和图形的页面</a>
								<ul>
									<li><a href="javascript:;">页面一</a></li>
									<li><a href="javascript:;">页面二</a></li>
								</ul>
							</li>
							<li><a href="javascript:;">选项卡和图形切换的页面</a></li>
							<li><a href="javascript:;">左右两个互动的页面</a></li>
							<li><a href="javascript:;">列表输入的页面</a></li>
							<li><a href="javascript:;">双层栏目列表的页面</a></li>
						</ul>
					</div>';
		return Html::tag('div',$this->_items,['class'=>'accordion','fillSpace'=>'sidebar']);
	}

	public function renderItems($_items){
        foreach ($_items as $i => $item) {
            if (isset($item['visible']) && !$item['visible']) {
                continue;
            } elseif(isset($item['menus']) && count($item['menus'])){
            	$_t = $item['menus'];
            	unset($item['menus']);
            	$this->_items .= Html::tag('ul',$this->renderItem($item),['class' => 'tree treeFolder']);
            	$this->renderItems($_t);
            	continue;
            }
            $this->_items .= $this->renderItem($item);
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

	}

	protected function renderHeader($item){
		return Html::tag('div',Html::tag('h2',Html::tag('span','Folder').$item['label']),['class'=>'accordionHeader']);
	}
	protected function renderContent($content){

	}
}
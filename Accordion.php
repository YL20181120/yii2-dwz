<?php

namespace yii\dwz;

use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\dwz\Tree;
class Accordion extends Widget
{
	public $items = [];

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
		return $this->render();
	}

	public function render(){
		$ret = '';

		foreach ($this->items as $v) {
			$ret .= Html::tag('div',Html::tag('h2',Html::tag('span','Folder').$v['label']),['class'=>'accordionHeader']);
			$ret .= Html::tag('div',Tree::widget(['items' => $v['menus'],'options'=>$this->options]),['class'=>'accordionContent']);
		}
		return $ret;
	}
}
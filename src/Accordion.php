<?php
/**
 * Created by Jasmine2.
 * FileName: Accordion.php
 * Date: 2016-4-26
 * Time: 11:07
 */

namespace jasmine2\dwz;

use Yii;
use jasmine2\dwz\helpers\Html;
use yii\base\InvalidConfigException;

class Accordion extends Widget
{
	public $items = [];
	public $params;
	public $route;
	public function init(){
		parent::init();
		if(empty($this->items)){
			throw new InvalidConfigException("param `menus` must be set in your `params.php`");
		}
		if ($this->route === null && Yii::$app->controller !== null) {
			$this->route = Yii::$app->controller->getRoute();
		}
		if ($this->params === null) {
			$this->params = Yii::$app->request->getQueryParams();
		}
	}
	public function run(){
		return $this->renderMenu();
	}
	public function renderMenu(){
		$ret = '';
		foreach ($this->items as $v) {
			$ret .= Html::tag('div',Html::tag('h2',Html::tag('span','Folder').$v['label']),['class'=>'accordionHeader']);
			$ret .= Html::tag('div',Tree::widget(['items' => $v['menus'],'options'=>$this->options]),['class'=>'accordionContent']);
		}
		return $ret;
	}
}
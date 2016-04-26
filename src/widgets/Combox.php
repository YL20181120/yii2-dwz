<?php
namespace jasmine2\dwz\widgets;
use jasmine2\dwz\helpers\Html;

/**
 * Created by Jasmine2.
 * FileName: Combox.php
 * Date: 2016-4-26
 * Time: 16:54
 */
class Combox extends InputWidget
{
	public $prompt = 'Please select';
	public $items = [];

	public function init()
	{
		parent::init();
		Html::addCssClass($this->options, 'combox');
	}
	public function run()
	{
		echo Html::beginTag('select',$this->options);
		echo Html::tag('option',$this->prompt ,['value' => 'all']);
		echo $this->renderItems();
		echo Html::endTag('select');
	}

	protected function renderItems(){
		foreach($this->items as $k => $v){
			echo Html::tag('option',$v,['value' => $k]);
		}
	}
}
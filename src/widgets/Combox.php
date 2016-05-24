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
	public $promptShow = true;
	public $prompt = 'Please select';
	public $items = [];

	public function init()
	{
		parent::init();
		$this->options['name'] = Html::getInputName($this->model, $this->attribute);
		$this->value = Html::getAttributeValue($this->model,$this->attribute);
		Html::addCssClass($this->options, 'combox');
	}
	public function run()
	{
		echo Html::beginTag('select',$this->options);
		if($this->promptShow)
			echo Html::tag('option',$this->prompt ,['value' => '-1']);
		echo $this->renderItems();
		echo Html::endTag('select');
	}

	protected function renderItems(){
		$content = '';
		foreach($this->items as $k => $v){
			if($this->value == $k){
				$content .= Html::tag('option', $v, ['value' => $k, 'selected' => 'selected']);
			} else {
				$content .= Html::tag('option',$v,['value' => $k]);
			}
		}
		return $content;
	}
}
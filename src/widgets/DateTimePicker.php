<?php
/**
 * Created by Jasmine2.
 * FileName: Datetime.php
 * Date: 2016-5-27
 * Time: 23:31
 */

namespace jasmine2\dwz\widgets;


use jasmine2\dwz\helpers\Html;
use yii\validators\RequiredValidator;
class DateTimePicker extends InputWidget
{
	public function init()
	{
		parent::init();
		$this->options['name'] = Html::getInputName($this->model, $this->attribute);
		$this->options['readonly'] = 'true';
		$this->value = Html::getAttributeValue($this->model,$this->attribute);
		foreach ($this->model->getActiveValidators($this->attribute) as $validator) {
			if ($validator instanceof RequiredValidator) {
				Html::addCssClass($this->options, 'required');
			}
		}
		Html::addCssClass($this->options, 'date');
	}

	public function run()
	{
		return Html::input('text',$this->options['name'],$this->value,$this->options).
			Html::a('选择','javascript:;',['class' => 'inputDateButton']);
	}
}
<?php
/**
 * Created by Jasmine2.
 * FileName: ActiveField.php
 * Date: 2016-4-26
 * Time: 21:47
 */

namespace jasmine2\dwz\widgets;

use jasmine2\dwz\helpers\Html;
use jasmine2\dwz\helpers\ArrayHelper;
use jasmine2\dwz\validators\DigitsValidator;
use yii\validators\EmailValidator;
use yii\validators\NumberValidator;
use yii\validators\RequiredValidator;
use yii\validators\UrlValidator;

class ActiveField extends \yii\widgets\ActiveField
{
	public $enableClientValidation = false;
	public $options = [
		'class' => '',
		'tag'   => 'p'
	];
	public $inputOptions = ['class' => ''];
	public $labelOptions = ['class' => ''];
	public $errorOptions = ['class' => ''];
	public $hintOptions = ['class' => 'unit'];
	public function textInput($options = [])
	{
		$options = array_merge($this->inputOptions, $options);
		$this->adjustLabelFor($options);
		$this->adjustValidateClass($options);
		$this->parts['{input}'] = Html::activeTextInput($this->model, $this->attribute, $options);
		return $this;
	}
	public function passwordInput($options = [])
	{
		$options = array_merge($this->inputOptions, $options);
		$this->adjustLabelFor($options);
		$this->adjustValidateClass($options);
		$this->parts['{input}'] = Html::activePasswordInput($this->model, $this->attribute, $options);

		return $this;
	}
	public function adjustValidateClass(&$options)
	{
		foreach ($this->model->getActiveValidators($this->attribute) as $validator) {
			/* @var $validator \yii\validators\Validator */
			if ($validator instanceof RequiredValidator) {
				Html::addCssClass($options, 'required');
			} elseif ($validator instanceof EmailValidator) {
				Html::addCssClass($options, 'email');
			} elseif ($validator instanceof UrlValidator) {
				Html::addCssClass($options, 'url');
			} elseif ($validator instanceof NumberValidator) {
				if($validator->integerOnly)
					Html::addCssClass($options, 'digits');
				else
					Html::addCssClass($options, 'number');
			}
		}
	}

	public function label($label = null, $options = [])
	{
		if ($label === false) {
			$this->parts['{label}'] = '';
			return $this;
		}

		$options = array_merge($this->labelOptions, $options);
		if ($label !== null) {
			$options['label'] = $label;
		}
		$options['tag'] = 'label';
		$this->parts['{label}'] = Html::activeLabel($this->model, $this->attribute, $options);
		return $this;
	}

	public function begin()
	{
		$options = $this->options;
		$tag = ArrayHelper::remove($options, 'tag', 'div');
		return Html::beginTag($tag, $options);
	}

	public function error($options = [])
	{
		$options = array_merge($this->errorOptions, $options);
		$options['for'] = Html::getInputId($this->model, $this->attribute);
		$this->parts['{error}'] = Html::tag('span','', $options);
		return $this;
	}

	public function textarea($options = [])
	{
		Html::addCssClass($options, 'editor');
		Html::addCssStyle($options, ['width' => '600px','height' => '300px']);
		return parent::textarea($options);
	}

	public function unit($content, $options = [])
	{
		$options = array_merge($this->hintOptions, $options);
		$options['hint'] = $content;
		if($content == "")
			$this->parts['{hint}'] = $content;
		else
			$this->parts['{hint}'] = Html::tag('span',$content,$options);
		return $this;
	}
}
<?php

namespace yii\dwz\widgets;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

class ActiveField extends \yii\widgets\ActiveField
{
	public $template = "<dl><dt>{label}</dt>\n<dd>{input}</dd>\n{hint}\n{error}</dl>";
	public $inputOptions = ['class' => 'textInput'];
	public function label($label = null, $options = []){
		return $label;
	}

	public function textInput($options = []) {
		$options = array_merge($this->inputOptions, $options);
        $this->adjustLabelFor($options);
        $this->parts['{input}'] = Html::activeTextInput($this->model, $this->attribute, $options);
        return $this;
	}

	public function dropDownList($items, $options = []){
		$options['class'] = 'combox';
		return parent::dropDownList($items,$options);
	}
}
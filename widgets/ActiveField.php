<?php

namespace yii\dwz\widgets;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

class ActiveField extends \yii\widgets\ActiveField
{
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
}
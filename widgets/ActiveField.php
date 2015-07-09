<?php

namespace yii\dwz\widgets;
use yii\helpers\ArrayHelper;
use yii\dwz\helpers\Html;

class ActiveField extends \yii\widgets\ActiveField
{
	public $template = "<dl><dt>{label}</dt>\n<dd>{input}\n{hint}\n{error}</dd></dl>";
	public $inputOptions = ['class' => 'textInput'];
	public $errorOptions = ['class' => 'error','tag' => 'span'];
	public $hintOptions  = ['class' => 'info','tag' => 'span'];

	public $datePickerCssOptions = ['date'];
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

    public function label($label = null, $options = [])
    {
    	var_dump($label);
        if ($label === false) {
            $this->parts['{label}'] = '';
            return $this;
        }

        $options = array_merge($this->labelOptions, $options);
        if ($label !== null) {
            $options['label'] = $label;
        }
        $this->parts['{label}'] = Html::activeLabel($this->model, $this->attribute, $options);

        return $this;
    }     
    public function render($content = null)
    {
        if ($content === null) {
            if (!isset($this->parts['{input}'])) {
                $this->parts['{input}'] = Html::activeTextInput($this->model, $this->attribute, $this->inputOptions);
            }
            if (!isset($this->parts['{label}'])) {
                $this->parts['{label}'] = Html::activeLabel($this->model, $this->attribute, $this->labelOptions);
            }
            if (!isset($this->parts['{error}'])) {
                $this->parts['{error}'] = Html::error($this->model, $this->attribute, $this->errorOptions);
            }
            if (!isset($this->parts['{hint}'])) {
                $this->parts['{hint}'] = Html::activeHint($this->model, $this->attribute, $this->hintOptions);
            }
            $content = strtr($this->template, $this->parts);
        } elseif (!is_string($content)) {
            $content = call_user_func($content, $this);
        }

        return $this->begin() . "\n" . $content . "\n" . $this->end();
    }  
    public function datePicker($options = []){
    	$options['class'] = implode('',$this->datePickerCssOptions);
    	$options = array_merge($this->inputOptions, $options);
        $this->adjustLabelFor($options);
        $this->parts['{input}'] = Html::activeTextInput($this->model, $this->attribute, $options);
        if(isset($options['showDatePickerButton'])?$options['showDatePickerButton']:true){
        	$this->parts['{input}'] .= Html::a('Choose','javascript:;',['class' => 'inputDateButton']);
        }
        return $this;
    }
}
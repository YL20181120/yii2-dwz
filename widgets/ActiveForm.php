<?php

namespace yii\dwz\widgets;
use yii\dwz\helpers\Html;
use yii\base\InvalidCallException;
use yii\helpers\Json;
/**
* 使用table布局
*/
class ActiveForm extends \yii\widgets\ActiveForm
{

	public $fieldClass = 'yii\dwz\widgets\ActiveField';

	public $options = ['class' => 'pageForm required-validate','onsubmit'=>'return validateCallback(this,navTabAjaxDone)','novalidate'=>'novalidate','enctype' => 'multipart/form-data'];

	public $formDivOptions = ['class' => 'pageFormContent nowrap','layoutH' => '100'];

    public $errorCssClass = 'error';

    public $navTabName = "";
    /**
     * Initializes the widget.
     * This renders the form open tag.
     */
    public function init()
    {
        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }
        echo Html::beginForm($this->action, $this->method, $this->options);
        echo Html::hiddenInput('navTabId',\yii\dwz\TreeVisitor::generateId($this->navTabName));
        echo Html::beginTag('div',$this->formDivOptions);
    }

    /**
     * Runs the widget.
     * This registers the necessary javascript code and renders the form close tag.
     * @throws InvalidCallException if `beginField()` and `endField()` calls are not matching
     */
    public function run()
    {
        if (!empty($this->_fields)) {
            throw new InvalidCallException('Each beginField() should have a matching endField() call.');
        }

        if ($this->enableClientScript) {
        }
        echo Html::endTag('div');
        echo Html::endForm();
    }	
}
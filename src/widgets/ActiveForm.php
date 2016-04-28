<?php
/**
 * Created by Jasmine2.
 * FileName: ActiveForm.php
 * Date: 2016-4-26
 * Time: 21:47
 */

namespace jasmine2\dwz\widgets;


use jasmine2\dwz\helpers\Html;

class ActiveForm extends \yii\widgets\ActiveForm
{
	public $fieldClass = 'jasmine2\dwz\widgets\ActiveField';
	public function init()
	{
		Html::addCssClass($this->options, 'pageForm required-validate');
		$this->options['onsubmit'] = 'return validateCallback(this)';
		parent::init();
		echo '<div class="pageFormContent" layoutH="55">';
	}

	public static function end()
	{
		echo Html::submitButton();
		return parent::end();
	}
}
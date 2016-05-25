<?php
/**
 * Created by Jasmine2.
 * FileName: ActiveForm.php
 * Date: 2016-4-26
 * Time: 21:47
 */

namespace jasmine2\dwz\widgets;

use Yii;
use jasmine2\dwz\helpers\Html;
use jasmine2\dwz\helpers\ArrayHelper;

class ActiveForm extends \yii\widgets\ActiveForm
{
	public $enableClientScript = false;
	public $fieldClass = 'jasmine2\dwz\widgets\ActiveField';
	public function init()
	{
		Html::addCssClass($this->options, 'pageForm required-validate');
		isset($this->options['onsubmit'])?:$this->options['onsubmit'] = 'return validateCallback(this,navTabAjaxDone);';
		parent::init();
		echo '<div class="pageFormContent" layoutH="97">';
	}

	public static function end()
	{
		echo Html::submitButton();
		return parent::end();
	}
	public function field($model, $attribute, $options = [])
	{
		$config = $this->fieldConfig;
		if ($config instanceof \Closure) {
			$config = call_user_func($config, $model, $attribute);
		}
		if (!isset($config['class'])) {
			$config['class'] = $this->fieldClass;
		}
		return Yii::createObject(ArrayHelper::merge($config, $options, [
			'model' => $model,
			'attribute' => $attribute,
			'form' => $this,
		]));
	}
}
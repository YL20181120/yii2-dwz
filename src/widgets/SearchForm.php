<?php
/**
 * Created by Jasmine2.
 * FileName: SearchForm.php
 * Date: 2016-5-24
 * Time: 20:52
 */

namespace jasmine2\dwz\widgets;

use jasmine2\dwz\helpers\Html;
class SearchForm extends \yii\widgets\ActiveForm
{
	public $enableClientScript = false;
	public $fieldClass = 'jasmine2\dwz\widgets\SearchField';

	public function init()
	{
		Html::addCssClass($this->options, 'searchContent');
		parent::init();
	}

	public function run()
	{
		$content = ob_get_clean();
		echo Html::hiddenInput('_csrf',\Yii::$app->request->getCsrfToken());
		echo Html::tag('ul',$content,['class' => 'searchContent']);
	}
}
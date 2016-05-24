<?php
/**
 * Created by Jasmine2.
 * FileName: CheckboxColumn.php
 * Date: 2016-5-16
 * Time: 9:26
 */

namespace jasmine2\dwz\grid;


use yii\grid\Column;
use jasmine2\dwz\helpers\Html;
class CheckboxColumn extends Column
{
	public $rel = 'ids';
	protected function renderHeaderCellContent()
	{
		return Html::input('checkbox',null,null,['group' => $this->rel,'class' => 'checkboxCtrl']);
	}
	protected function renderDataCellContent($model, $key, $index)
	{
		if (!isset($options['value'])) {
			$options['value'] = is_array($key) ? json_encode($key, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) : $key;
		}
		return Html::input('checkbox', $this->rel, $options['value']);
	}
}
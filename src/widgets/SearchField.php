<?php
/**
 * Created by Jasmine2.
 * FileName: SearchField.php
 * Date: 2016-5-24
 * Time: 20:52
 */

namespace jasmine2\dwz\widgets;


class SearchField extends \yii\widgets\ActiveField
{
	public $enableClientValidation = false;
	public $options = [
		'class' => '',
		'tag'   => 'li'
	];
	public $template = "{label}\n{input}";
	public $inputOptions = ['class' => ''];
	public $labelOptions = ['class' => ''];
}
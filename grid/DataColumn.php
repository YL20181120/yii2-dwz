<?php
namespace yii\dwz\grid;

/**
* 
*/
class DataColumn extends \yii\grid\Column
{
	public $attribute;

	public $format;

	public $label;

	public $enableSorting = false;
}
<?php
namespace yii\dwz\grid;

/**
* 
*/
class DataColumn extends \yii\grid\Column
{
	public $attribute;

	public $format = 'text';

	public $label;

	public $enableSorting = false;

	public $value;

	public function renderHeaderCellContent(){
        $provider = $this->grid->dataProvider;
		//\yii\helpers\VarDumper::dump($provider);
		return "hh";
	}
}
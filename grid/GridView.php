<?php
namespace yii\dwz\grid;
use yii\grid\GridView as Grid;
use yii\grid\DataColumn;
use yii\helpers\Html;
class GridView extends Grid
{
	public $rel;
	public $summary = false;
	public $tableOptions = ['class' => 'table','style' => 'width:100%;'];

	public function renderSummary(){
		if(!$this->summary){

		} else {
			return null;
		}
	}
	public function init(){
		parent::init();
		foreach ($this->columns as $i => $column) {
			if($column instanceof DataColumn) {
				$column->sortLinkOptions = ['target' => 'navTab','rel' => $this->rel,'class' => 'j-ajax'];
				$this->columns[$i] = $column;
			}
		}
	}
	public function renderPager(){
		return 'pager';
	}
}

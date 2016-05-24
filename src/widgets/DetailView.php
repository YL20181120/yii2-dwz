<?php
/**
 * Created by Jasmine2.
 * FileName: DetailView.php
 * Date: 2016-5-3
 * Time: 22:25
 */

namespace jasmine2\dwz\widgets;

use jasmine2\dwz\helpers\ArrayHelper;
use jasmine2\dwz\helpers\Html;

class DetailView extends \yii\widgets\DetailView
{
	//分几列显示数据
	public $columns = 1;
	public $template = "<th>{label}</th><td>{value}</td>";
	public $options = ['class' => 'list','style'=>'width:100%;'];
	public function run()
	{
		$rows = [];
		$i = 0;
		foreach ($this->attributes as $attribute) {
			$rows[] = $this->renderAttribute($attribute, $i++);
		}
		$t = [];
		$len = count($rows);
		for($j = 0;$j < $len;$j++){
			if(fmod($j,$this->columns) == 0){
				$rows[$j] = '<tr>' . $rows[$j];
			} elseif(fmod($j,$this->columns) == $this->columns -1) {
				$rows[$j] .= '</tr>';
			}
			if($j == $len - 1){
				$_len = $this->columns - (fmod($j,$this->columns) + 1);
				for($i = 0;$i < $_len;$i++){
					$rows[$j] .= strtr($this->template, [
						'{label}' => '&nbsp;',
						'{value}' => '&nbsp;',
					]);
				}
				$rows[$j] .= '</tr>';
			}
		}
		$options = $this->options;
		$tag = ArrayHelper::remove($options, 'tag', 'table');
		echo Html::tag($tag, implode("\n", $rows), $options);
	}
}
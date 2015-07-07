<?php
namespace yii\dwz\widgets;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
* 
*/
class DetailView extends \yii\widgets\DetailView
{
	//分几列显示数据
	public $columns = 1;

    public $template = "<td><b>{label}</b></td><td>{value}</td>";

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
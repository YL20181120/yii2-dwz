<?php
namespace yii\dwz\helpers;

class ArrayHelper extends \yii\helpers\ArrayHelper {
	public static function toString(array $arr){
		$_s = "";
		foreach ($arr as $key => $value) {
			$_s .= "[$value]";
		}
		return $_s;
	}

	public static function map($array, $from, $to, $group = null){
	    $result = [];
        foreach ($array as $element) {
        	if($from == $to){
        		$key = $value = static::getValue($element,$from);
        	} else {
	            $key = static::getValue($element, $from);
	            $value = static::getValue($element, $to);
	        }
            if ($group !== null) {
            	$_t = static::getValue($element,$group);
                $result[static::getValue($element, $from)] = '['.$_t . '-' .$value .']';
            } else {
	            $result[$key] = '['. $value .']';
            }
        }
        return $result;	
	}

	public static function toDwzJson($array,$from, $to, $group = null) {
		$result[] = '["","请选择"]';
		foreach ($array as $element) {
        	if($from == $to){
        		$key = $value = static::getValue($element,$from);
        	} else {
	            $key = static::getValue($element, $from);
	            $value = static::getValue($element, $to);
	        }
            if ($group !== null) {
            	$_t = static::getValue($element,$group);
                $result[] = '["'. $key .'","['.$_t . '-' .$value .']"]';
            } else {
	            $result[] = '["'. $key .'","['.$value .']"]';
            }
        }
        return '['.implode(',',$result).']';
	}
}
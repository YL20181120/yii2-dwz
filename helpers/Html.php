<?php
namespace yii\dwz\helpers;
use yii\helpers\ArrayHelper;
use Yii;
/**
* 
*/
class Html extends \yii\helpers\BaseHtml
{
    public static function activeLabel($model, $attribute, $options = [])
    {
        $for = array_key_exists('for', $options) ? $options['for'] : static::getInputId($model, $attribute);
        $attribute = static::getAttributeName($attribute);
        $label = isset($options['label']) ? $options['label'] : static::encode($model->getAttributeLabel($attribute));
        return static::tag('dt',$label);
    } 
    public static function error($model, $attribute, $options = [])
    {
        $attribute = static::getAttributeName($attribute);
        $error = $model->getFirstError($attribute);
        if($error != null) {
	        $tag = isset($options['tag']) ? $options['tag'] : 'div';
	        $encode = !isset($options['encode']) || $options['encode'] !== false;
	        unset($options['tag'], $options['encode']);
	        return Html::tag($tag, $encode ? Html::encode($error) : $error, $options);
	    } else {
	    	return "";
	    }
    }

/*    public static function activeTextInput($model, $attribute, $options = []) {
    	$inputID = Html::getInputId($model, $attribute);
        $attribute = Html::getAttributeName($attribute);
        $options = $options;
        $class = isset($options['class']) ? [$options['class']] : [];
        $class[] = "field-$inputID";
        if ($model->isAttributeRequired($attribute)) {
            $class[] = $form->requiredCssClass;
        }
        if ($model->hasErrors($attribute)) {
            $class[] = $form->errorCssClass;
        }
        $class = implode(' ', $class);
        var_dump($class);
    }*/
}
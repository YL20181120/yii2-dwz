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
        return $label;
    }   
}
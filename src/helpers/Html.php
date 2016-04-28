<?php
namespace jasmine2\dwz\helpers;
/**
 * Created by Jasmine2.
 * FileName: Html.php
 * Date: 2016-4-25
 * Time: 09:16
 */
class Html extends \yii\helpers\Html
{
	public static function divider(){
		return static::tag('div','',['class' => 'divider']);
	}

	public static function submitButton($content = '', $options = []){
		echo '</div><div class="formBar">
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">提交</button></div></div></li>
				<li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
			</ul>
		</div>';
	}

	public static function activeInput($type, $model, $attribute, $options = [])
	{
		$name = isset($options['name']) ? $options['name'] : static::getInputName($model, $attribute);
		$value = isset($options['value']) ? $options['value'] : static::getAttributeValue($model, $attribute);
		if (!array_key_exists('id', $options)) {
			$options['id'] = static::getInputId($model, $attribute);
		}
		return static::input($type, $name, $value, $options);
	}

	public static function activeLabel($model, $attribute, $options = [])
	{
		$attribute = static::getAttributeName($attribute);
		$label = ArrayHelper::remove($options, 'label', static::encode($model->getAttributeLabel($attribute)));
		$tag = ArrayHelper::remove($options, 'tag', 'dt');
		return static::tag($tag, $label, $options);
	}
}
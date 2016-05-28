<?php
/**
 * Created by Jasmine2.
 * FileName: NumberValidator.php
 * Date: 2016-5-27
 * Time: 22:51
 */

namespace jasmine2\dwz\validators;


use yii\validators\Validator;

class CreditCardValidator extends Validator
{
	// 信用卡
	public function validateAttribute($model, $attribute)
	{
		return true;
	}
}
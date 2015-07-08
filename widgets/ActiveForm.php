<?php

namespace yii\dwz\widgets;

/**
* 使用table布局
*/
class ActiveForm extends \yii\widgets\ActiveForm
{

	public $fieldClass = 'yii\dwz\widgets\ActiveField';

	public $options = ['class' => 'pageFormContent'];
}
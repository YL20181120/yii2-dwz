<?php

namespace yii\dwz;

use yii\web\AssetBundle;

/**
* 
*/
class DwzAsset extends AssetBundle
{
	public $sourcePath = '@yii/dwz/assets';

	public $css = [
		'css/themes/default/style.css',
		'css/themes/css/core.css',
	];
	public $js = [
		'js/jquery-1.7.2.js',
		'js/jquery.cookie.js',
		'js/jquery.validate.js',
		'js/jquery.bgiframe.js',
		'js/dwz.min.js',
		'js/dwz.regional.zh.js',
	];
}
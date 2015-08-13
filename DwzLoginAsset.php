<?php

namespace yii\dwz;

use yii\web\AssetBundle;

/**
* 
*/
class DwzLoginAsset extends AssetBundle
{
	public $sourcePath = '@yii/dwz/assets/login';

	public $css = [
		'css/normalize.css',
		'css/default.css',
		'css/styles.css',
	];

	public $js = [
		'js/jquery-2.1.1.min.js'
	];
}
<?php

namespace yii\dwz;

use yii\web\AssetBundle;

/**
* 
*/
class FileUploadAsset extends AssetBundle
{
	public $sourcePath = '@yii/dwz/assets/uploadify';

	public $css = [
		'css/uploadify.css',
	];
	public $js = [
		'scripts/my.js',
		'scripts/jquery.uploadify.min.js',
	];
}
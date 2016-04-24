<?php
namespace jasmine2\dwz;
use yii\web\AssetBundle;

/**
 * Created by Jasmine2.
 * FileName: LayoutAsset.php
 * Date: 2016-4-22
 * Time: 08:58
 */
class DwzAsset extends AssetBundle
{
	public $sourcePath = '@jasmine2/dwz/assets';

	public $css        = [
		'themes/default/style.css',
		'themes/css/core.css',
	];

	public $js         = [
		'js/jquery.cookie.js',
		'js/jquery.validate.js',
		'js/jquery.bgiframe.js',
		'js/dwz.min.js',
		'js/dwz.regional.zh.js'
	];
}
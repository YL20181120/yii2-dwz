<?php
namespace jasmine2\dwz;
use yii\web\AssetBundle;

/**
 * @author Jasmine2.
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
		'xheditor/xheditor-1.2.2.min.js',
		'xheditor/xheditor_lang/zh-cn.js',
		'js/dwz.min.js',
		'js/dwz.regional.zh.js'
	];
}
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
		//'js/dwz.min.js',
		'js/dwz.core.js',
		'js/dwz.util.date.js',
		'js/dwz.validate.method.js',
		'js/dwz.barDrag.js',
		'js/dwz.drag.js',
		'js/dwz.tree.js',
		'js/dwz.accordion.js',
		'js/dwz.ui.js',
		'js/dwz.theme.js',
		'js/dwz.switchEnv.js',
		'js/dwz.alertMsg.js',
		'js/dwz.contextmenu.js',
		'js/dwz.navTab.js',
		'js/dwz.tab.js',
		'js/dwz.resize.js',
		'js/dwz.dialog.js',
		'js/dwz.dialogDrag.js',
		'js/dwz.sortDrag.js',
		'js/dwz.cssTable.js',
		'js/dwz.stable.js',
		'js/dwz.taskBar.js',
		'js/dwz.ajax.js',
		'js/dwz.pagination.js',
		'js/dwz.database.js',
		'js/dwz.datepicker.js',
		'js/dwz.effects.js',
		'js/dwz.panel.js',
		'js/dwz.checkbox.js',
		'js/dwz.history.js',
		'js/dwz.combox.js',
		'js/dwz.print.js',
		'js/dwz.regional.zh.js',
	];
}
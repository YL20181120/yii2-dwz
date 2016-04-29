YII2-DWZ
================

###dwz ui for yii2

[![Latest Stable Version](https://poser.pugx.org/jasmine2/yii2-dwz/v/stable)](https://packagist.org/packages/jasmine2/yii2-dwz) 
[![Total Downloads](https://poser.pugx.org/jasmine2/yii2-dwz/downloads)](https://packagist.org/packages/jasmine2/yii2-dwz) 
[![Latest Unstable Version](https://poser.pugx.org/jasmine2/yii2-dwz/v/unstable)](https://packagist.org/packages/jasmine2/yii2-dwz) 
[![License](https://poser.pugx.org/jasmine2/yii2-dwz/license)](https://packagist.org/packages/jasmine2/yii2-dwz)

#Install
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).
Either run

```php
composer require jasmine2/yii2-dwz:2.0.x-dev
```

or add 

```php
jasmine2/yii2-dwz:2.0.x-dev
```

to the require-dev section of your `composer.json` file.
#Usage
---
######1.First,add alias to you config file,like this:
```php
'aliases'   => [
        'jasmine2/dwz' => '@vendor/jasmine2/yii2-dwz/src',
        ...
    ],
```
######2.Second,you should make sure all your controller extends jasmine2\dwz\Controller ,except SiteController;In the SiteController ,you should add layout file;
```php
public $layout = '@jasmine2/dwz/layouts/main';
```
######1. Alert

要显示一个Alert，只要像下面这样设置一个Flash即可，支持`error`,`warning`,`success`和`info`4中类型的提示窗口

注意：同时设置多个Flash时只有最后一个会正常显示。

```php
 Yii::$app->getSession()->setFlash('error', 'This is the message');
 Yii::$app->getSession()->setFlash('success', 'This is the message');
 Yii::$app->getSession()->setFlash('info', 'This is the message');
```

######2. Button

```php
<?= Button::widget([
	'aClassButton' => true,
	'content' => '正常按钮',
	'buttonOptions' => [
		'onclick' => 'alertMsg.info("Hello")'
	]
])?>
<?= Button::widget([
	'aClassButton' => true,
	'type' => 'active',
	'content' => '激活按钮',
	'buttonOptions' => [
		'onclick' => 'alertMsg.error("Hello")'
	]
])?>
<?= Button::widget([
	'aClassButton' => true,
	'type' => 'disabled',
	'content' => '禁用按钮',
	'buttonOptions' => [
		'onclick' => 'alertMsg.warning("Hello")'
	]
])?>
```

######3. Dialog

```php
/**
	更多配置可以写在options中
	minable:	dialog 是否可最小化,
	mixable:	dialog 是否可最大化
	resizable: dialog 是否可变大小
	drawable: dialog 是否可拖动
	width:	dialog 打开时的默认宽度
	height:	dialog 打开时默认的高度
	width,height分别打开dialog时的宽度与高度.
	fresh:	重复打开dialog时是否重新载入数据,默认值true,
	close:	关闭dialog时的监听函数,需要有boolean类型的返回值,
	param:	close监听函数的参数列表,以json格式表示,例{msg:’message’}
	 */
<?= Dialog::widget([
	'title' => 'Index/index',
	'mask'  => false,
	'url'   => ['index/index']
])
?>
```

######4. Panel

```php
<?php
		$panel  = new Panel([
			'title' => 'Panel',
			'collapse' => true,
		]);
		$panel->beginPanel();
		?>
		<pre>
		DWZ富客户端框架

		在线演示地址	http://j-ui.com/
		下载地址	http://code.google.com/p/dwz/

		官方微博： http://weibo.com/dwzui

		DWZ创始人：
		[北京]杜权(UI设计)		d@j-ui.com
		[杭州]吴平(Ajax开发)	w@j-ui.com
		[北京]张慧华(Ajax开发)	z@j-ui.com

		新加入成员：
		[北京]张涛	QQ:122794105
		[北京]冀刚	QQ:63502308	jiweigang2008@tom.com
		[北京]郑应海	QQ:55691650
		[成都]COCO	QQ:80095667

		有问题尽量发邮件或微博
		</pre>
		<?php
		$panel->endPanel();
		?>
```

######5. Tabs

```php
<?php
			echo Tabs::widget([
				'items' => [
					[
						'title' => '标题1',
						'content' => '<pre>Hello</pre>'
					],
					[
						'title' => '标题2',
						'url'   => ['site/contact']
					]
				]
			]);
		?>
```

######6. Accordion
- add the `menu` key to your `params.php` ,like this:

```php
'menus'      => [
		[
			'label'=>'菜单测试',
			'menus' => [
				[
					'label' => '一级菜单',
					'menus' => [
						[
							'label' => '二级菜单',
							'menus' => [
								[
									'label' => '三级菜单',
									'url'   => ['site/contact'],
									'visible' => false // don't show this menu
								]
							]
						],
						[
							'label' => 'About us',
							'url'   => ['site/about'],
						]
					]
				],
			],
		],
	]
	... other params
```
- Accordion type
    - tree
    - tree [treeFolder]
    - tree [treeFolder] expend
    - tree [treeFolder] collapse
    
`<?= \jasmine2\dwz\Accordion::widget(['items'=>isset(\Yii::$app->params['menus'])?\Yii::$app->params['menus']:null,'options'=>['class'=>'tree treeFolder']])?>`    
* [http://jui.org/](http://jui.org/)
* [http://yiiframework.com](http://yiiframework.com)
* [http://www.yiichina.com/](http://www.yiichina.com/)

DWZ富客户端框架
=========
DWZ富客户端框架

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist vendor/yii2-dwz "*"
```

or add

```
"vendor/yii2-dwz": "*"
```

to the require section of your `composer.json` file.


Usage
-----
1.Panel 面板
```php
<?php
use yii\dwz\Panel;
Panel::begin(['title'=>'Panel Title','class'=>'panel collapse close']);
?>
<table></table>
<?php
Panel::end();
?>
```
2.Tabs 标签页
```php
<?php
use yii\dwz\Tabs;
echo Tabs::widget(['items'=>[
		['title'=>'t1','url'=>'','content'=>'t1 content'],
		['title'=>'t2','url'=>['user/index'],'content'=>'']
	],'contentStyle'=>'height:300px']);
?>
```

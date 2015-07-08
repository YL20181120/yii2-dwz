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
3.Alert 弹出提示
```php
<?php
echo Alert::widget([
	'type'   => 'error',
	'content' => 'error',
	'message' => '您的数据提交成功！'
	]);
?><br>
<?php echo Alert::widget([
	'type'   => 'success',
	'content' => 'success',
	'message' => '您的数据提交成功！'
	]);
?><br>
<?php
echo Alert::widget([
	'type'   => 'warning',
	'content' => 'warning',
	'message' => '您的数据提交成功！'
	]);
?><br>
<?php
echo Alert::widget([
	'type'   => 'info',
	'content' => 'info',
	'message' => '您的数据提交成功！'
	]);
?><br>
<?php
echo Alert::widget([
	'type'   => 'javascript',
	'content' => '自定义JAVASCRIPT',
	'message' => 'test()'
	]);
?><br>

<script type="text/javascript">
function test(){
	alert("test");
}
</script>
```
4.Dialog 对话框

```php
<?php
user yii\dwz\Dialog;

echo Dialog::widget([
		'rel' 	=> 'only_rel',
		'title' => 'Show title',
		'width' => '800',	//default 600
		'height'=> '600',	//default 300
		'mask'	=> false, //default true
	]);
```
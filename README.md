#YII2-DWZ
###dwz ui for yii2
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
#Useage
---

1. First,add alias to you config file,like this:

```php
'aliases'   => [
        'jasmine2/dwz' => '@vendor/jasmine2/yii2-dwz/src',
        ...
    ],
```

2. Second,you should make sure all your controller extends jasmine2\dwz\Controller ,except SiteController;
In the SiteController ,you should add layout file;

```php
public $layout = '@jasmine2/dwz/layouts/main';
```

1. Alert

要显示一个Alert，只要像下面这样设置一个Flash即可，支持`error`,`warning`,`success`和`info`4中类型的提示窗口

注意：同时设置多个Flash时只有最后一个会正常显示。

```php
 Yii::$app->getSession()->setFlash('error', 'This is the message');
 Yii::$app->getSession()->setFlash('success', 'This is the message');
 Yii::$app->getSession()->setFlash('info', 'This is the message');
```




* [http://jui.org/](http://jui.org/)
* [http://yiiframework.com](http://yiiframework.com)
* [http://www.yiichina.com/](http://www.yiichina.com/)

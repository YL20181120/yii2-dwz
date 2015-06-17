<?php
namespace yii\dwz;
use yii\helpers\Html;
/**
* Tab标签页
*/
class Tab extends \yii\base\Object
{
	public $title;
	public $url;
	public $content;


	public function init(){
		parent::init();
		if(!(!empty($this->url) xor !empty($this->content)))
			throw new \yii\base\InvalidConfigException("Url or Content must be exsit one");
	}
}
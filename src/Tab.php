<?php
/**
 * Created by Jasmine2.
 * FileName: Tab.php
 * Date: 2016-4-25
 * Time: 21:29
 */

namespace jasmine2\dwz;


use yii\base\InvalidConfigException;
use yii\base\Object;

class Tab extends Object
{
	public $title   = null;
	public $url     = null;
	public $content = null;

	public function init()
	{
		//检测初始值
		if($this->title == null){
			throw new InvalidConfigException("param `title` must be set");
		}

		if(!($this->url || $this->content)){
			throw new InvalidConfigException("param `url` or `content` must be set");
		}
	}
}
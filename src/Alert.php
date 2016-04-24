<?php
/**
 * Created by Jasmine2.
 * FileName: Alert.php
 * Date: 2016-4-24
 * Time: 08:37
 */

namespace jasmine2\dwz;


use yii\base\InvalidConfigException;
use yii\helpers\Html;

class Alert extends Widget
{
	public $message;

	public $type = 'info';

	public $content;

	const TYPE_RANGE = ['info','warning','success','error','javascript'];
	public function init()
	{
		parent::init();
		if(empty($this->content)){
			throw new InvalidConfigException("`content` can't be null");
		}
		if(!in_array($this->type,self::TYPE_RANGE)){
			throw new InvalidConfigException("Param `type` must in range '".implode(' ', self::TYPE_RANGE)."'",1);
		}
	}

	public function run()
	{
			return $this->renderAlert();
	}

	protected function renderAlert(){
		switch ($this->type) {
			case 'warning':
				$this->options['onclick'] = "alertMsg.warn('".$this->message."')";
				break;
			case 'success':
				$this->options['onclick'] = "alertMsg.correct('".$this->message."')";
				break;
			case 'error':
				$this->options['onclick'] = "alertMsg.error('".$this->message."')";
				break;
			//确认窗口
			case 'javascript':
				$this->options['onclick'] = $this->message;
				break;
			case 'info':
				$this->options['onclick'] = "alertMsg.info('".$this->message."')";
				break;
		}
		return Html::a($this->content,'javascript:;',$this->options);
	}
}
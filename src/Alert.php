<?php
/**
 * @author Jasmine2.
 * FileName: Alert.php
 * Date: 2016-4-24
 * Time: 08:37
 */

namespace jasmine2\dwz;
/**
 * Alert widget renders a message from session flash. Just last flash messages are displayed
 * You can set message as following:
 *
 * - \Yii::$app->getSession()->setFlash('error', 'This is the message');
 * - \Yii::$app->getSession()->setFlash('success', 'This is the message');
 * - \Yii::$app->getSession()->setFlash('info', 'This is the message');
 */

use yii\base\InvalidConfigException;
use yii\helpers\Html;

class Alert extends Widget
{
	public $message;

	public $type = 'info';

	private $javascript;

	const TYPE_RANGE = ['info','warning','success','error'];

	public function init()
	{
		parent::init();
		if(empty($this->message)){
			throw new InvalidConfigException("`message` can't be null");
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
				$this->javascript = "alertMsg.warn('".$this->message."');";
				break;
			case 'success':
				$this->javascript = "alertMsg.correct('".$this->message."');";
				break;
			case 'error':
				$this->javascript = "alertMsg.error('".$this->message."');";
				break;
			case 'info':
				$this->javascript = "alertMsg.info('".$this->message."');";
				break;
		}
		return Html::tag('script',$this->javascript);
	}
}
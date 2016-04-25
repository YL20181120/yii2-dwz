<?php
namespace jasmine2\dwz\behaviors;
use yii\base\Behavior;
use yii\web\Controller;

/**
 * Created by Jasmine2.
 * FileName: NoCsrfBehavior.php
 * Date: 2016-4-25
 * Time: 09:35
 */
class NoCsrfBehavior extends Behavior
{
	public $actions = [];
	public $controller;
	public function events()
	{
		return [Controller::EVENT_BEFORE_ACTION => 'beforeAction'];
	}

	public function beforeAction($event){
		$action = $event->action->id;
		if(in_array($action,$this->actions)){
			$this->controller->enableCsrfValidation = false;
		}
	}
}
<?php
/**
 * @author Jasmine2.
 * FileName: Controller.php
 * Date: 2016-4-24
 * Time: 21:36
 */

namespace jasmine2\dwz;


use jasmine2\dwz\Alert;

class Controller extends \yii\web\Controller
{
	public function render($view, $params = [])
	{
		return $this->renderAjax($view, $params);
	}

	public function beforeAction($action)
	{
		$session = \Yii::$app->getSession();
		$flashes = $session->getAllFlashes();
		$types = Alert::TYPE_RANGE;
		foreach($flashes as $type => $message){
			if(in_array($type,$types)){
				echo Alert::widget([
					'type' => $type,
					'message' => $message,
				]);
				$session->removeFlash($type);
			}
		}

		return parent::beforeAction($action);
	}
}
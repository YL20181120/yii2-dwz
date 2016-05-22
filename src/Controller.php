<?php
/**
 * @author Jasmine2.
 * FileName: Controller.php
 * Date: 2016-4-24
 * Time: 21:36
 */

namespace jasmine2\dwz;



use yii\web\Response;

class Controller extends \yii\web\Controller
{
	const TIMEOUT = [
		"statusCode"=>"301",
		"message"=>"会话超时",
	];
	const SUCCESS = [
		"statusCode"=>"200",
		"message"=>"操作成功",
	];
	const ERROR = [
		"statusCode"=>"300",
		"message"=>"操作失败"
	];
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
		\Yii::$app->response->format = Response::FORMAT_JSON;
		return parent::beforeAction($action);
	}
}
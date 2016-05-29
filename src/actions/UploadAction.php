<?php
/**
 * Created by Jasmine2.
 * FileName: UploadAction.php
 * Date: 2016-5-28
 * Time: 22:49
 */

namespace jasmine2\dwz\actions;


use Yii;
use yii\base\Action;
use yii\base\InvalidCallException;
use yii\base\InvalidConfigException;
use yii\helpers\FileHelper;
use yii\web\BadRequestHttpException;
use yii\web\Response;
use yii\web\UploadedFile;
class UploadAction extends Action {
	public $paramName = 'file';
	public $path;
	public function init()
	{
		if ($this->path === null) {
			throw new InvalidConfigException('The "path" attribute must be set.');
		} else {
			$this->path = FileHelper::normalizePath(Yii::getAlias($this->path)) . DIRECTORY_SEPARATOR;
			if (!FileHelper::createDirectory($this->path)) {
				throw new InvalidCallException("Directory specified in 'path' attribute doesn't exist or cannot be created.");
			}
		}
	}
	public function run(){
		if (Yii::$app->request->isPost) {
			$file = UploadedFile::getInstanceByName($this->paramName);
			if($file){
				$filename = uniqid() . '.' . $file->extension;
				if($file->saveAs($this->path.$filename)){
					$result = ['name' => $filename,'id' => Yii::$app->request->post('id')];
				}
			} else {
				$result = ['error' => 'no-object'];
			}
			Yii::$app->response->format = Response::FORMAT_JSON;
			return $result;
		} else {
			throw new BadRequestHttpException('Only POST is allowed');
		}
	}
}
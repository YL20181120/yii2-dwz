<?php
/**
 * Created by Jasmine2.
 * FileName: UploadifyInput.php
 * Date: 2016-5-28
 * Time: 16:22
 */

namespace jasmine2\dwz\widgets;

use jasmine2\dwz\DwzAsset;
use jasmine2\dwz\helpers\ArrayHelper;
use jasmine2\dwz\helpers\Html;
use yii\helpers\Json;
use yii\validators\RequiredValidator;
class UploadifyInput extends InputWidget
{
	public $paramName = 'file';
	public $uploaderOptions = [];
	public $buttonText = '请选择文件';
	public $fileSizeLimit = '200KB';
	public $fileTypeDesc = '*.jpg;*.jpeg;*.gif;*.png;';
	public $fileTypeExts = '*.jpg;*.jpeg;*.gif;*.png;';
	public $auto = 'true';
	public $multi = 'false';
	public $onUploadSuccess = 'myUploadSuccess';
	public $onUploadError = 'myUploadError';
	public $baseUrl;
	public $content;
	public $uploader = '';
	public $formData = [];
	public function init()
	{
		$this->baseUrl = \Yii::$app->assetManager->getBundle(DwzAsset::className())->baseUrl;
		$this->uploaderOptions = array_merge($this->uploaderOptions,[
			'swf'       => $this->baseUrl . '/uploadify/scripts/uploadify.swf',
			'buttonText'    => $this->buttonText,
			'uploader'      => $this->uploader,
			'formData'      => $this->formData,
			'fileSizeLimit' => $this->fileSizeLimit,
			'fileTypeDesc' => $this->fileTypeDesc,
			'fileTypeExts' => $this->fileTypeExts,
			'auto' => $this->auto,
			'multi' => $this->multi
		]);
		$this->registerResource();
		foreach ($this->model->getActiveValidators($this->attribute) as $validator) {
			if ($validator instanceof RequiredValidator) {
				Html::addCssClass($this->options, 'required');
			}
		}

		$this->options['uploaderOption'] = Json::encode($this->uploaderOptions);
		parent::init();
	}
	private function registerResource(){
		$this->content .= '<link rel="stylesheet" href="'. $this->baseUrl .'/uploadify/css/uploadify.css"/>'."\n";
		$this->content .= '<script src="'. $this->baseUrl .'/uploadify/scripts/jquery.uploadify.min.js"/>'."\n";
		$this->content .= '<script src="'. $this->baseUrl .'/js/dwz.uploadify.js"/>'."\n";
	}
	public function run()
	{
		$this->content .= Html::fileInput($this->paramName,Html::getAttributeValue($this->model, $this->attribute),$this->options)."\n";
		ArrayHelper::remove($this->options, 'uploaderOption');
		$this->options['id'] = $this->formData['id'];
		$this->content .= Html::input('hidden',Html::getInputName($this->model,$this->attribute),Html::getAttributeValue($this->model,$this->attribute),$this->options);
		return $this->content;
	}
}
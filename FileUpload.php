<?php
namespace yii\dwz;
use yii\widgets\InputWidget;
use yii\helpers\Html;
use yii\helpers\Url;
use Yii;
/**
* 
*/
class FileUpload extends InputWidget
{
	public $url;
	public $formData = [];
	public $buttonText = "请选择文件";
	public $fileSizeLimit = '2048KB';
	public $fileTypeDesc  = '*.*';
	public $fileTypeExts  = '*.*';
	public $auto = 'true';
	public $multi = 'false';
	public function run() {
		$view = $this->getView();
		FileUploadAsset::register($view);
		$this->createUploaderOptions();
		$this->options['class'] = 'required';
		echo Html::hiddenInput(Html::getInputName($this->model,$this->attribute),'',['id' => 'dwz-file-uploader']);
		echo Html::activeInput('file',$this->model,$this->attribute,$this->options);
	}

	protected function createUploaderOptions(){
		$request = Yii::$app->getRequest();
		$this->formData[$request->csrfParam] = $request->getCsrfToken();
		$options['uploader'] = Url::to($this->url);
		$options['swf'] = $this->getView()->getAssetManager()->bundles['yii\dwz\FileUploadAsset']->baseUrl.'/scripts/uploadify.swf';
		$options['buttonText'] = $this->buttonText;
		$options['fileTypeExts'] = $this->fileTypeExts;
		$options['fileTypeDesc'] = $this->fileTypeDesc;
		$options['auto']		 = $this->auto;
		$options['multi']		 = $this->multi;
		$options['formData']     	= $this->formData;
		$this->options['uploaderOption'] = json_encode($options,JSON_UNESCAPED_UNICODE);
	}
}
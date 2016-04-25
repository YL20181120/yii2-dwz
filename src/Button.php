<?php
/**
 * Created by Jasmine2.
 * FileName: Button.php
 * Date: 2016-4-25
 * Time: 09:06
 */

namespace jasmine2\dwz;


use yii\base\InvalidConfigException;
use jasmine2\dwz\helpers\Html;
class Button extends Widget
{
	// 链接类型按钮
	public $aClassButton = false;

	public $content = 'Button';

	public $buttonOptions = [];

	public $type = 'button';

	const TYPE   = ['button', 'active', 'disabled'];

	public function init()
	{
		parent::init();

		if(!in_array($this->type, self::TYPE)){
			throw new InvalidConfigException('Param `type` must in range ['.implode(',',self::TYPE).']',1);
		}
	}

	public function run(){
		switch($this->type){
			case 'active':
				$this->options['class'] = 'buttonActive';
				break;
			case 'disabled':
				$this->options['class'] = 'buttonDisabled';
				break;
			default:
				$this->options['class'] = 'button';
				break;
		}
		if($this->aClassButton){
			return Html::a(Html::tag('span',$this->content,$this->buttonOptions),'javascript:;',$this->options);
		}
		return Html::tag('div',Html::tag('div',
				Html::tag('button',$this->content, $this->buttonOptions),
				['class' => 'buttonContent']),
			$this->options
		);
	}
}
<?php
/**
 * @author Jasmine2.
 * FileName: Widget.php
 * Date: 2016-4-24
 * Time: 08:38
 */

namespace jasmine2\dwz;


class Widget extends \yii\base\Widget
{
	public $options = [];

	public function init()
	{
		parent::init();
		if (!isset($this->options['id'])) {
			$this->options['id'] = $this->getId();
		}
	}
}
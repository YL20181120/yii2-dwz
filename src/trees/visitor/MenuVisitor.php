<?php
/**
 * Created by Jasmine2.
 * FileName: MenuVisitor.php
 * Date: 2016-4-26
 * Time: 10:54
 */

namespace jasmine2\dwz\trees\visitor;

use jasmine2\dwz\helpers\Html;
use jasmine2\dwz\trees\node\NodeInterface;
use yii\base\InvalidConfigException;

class MenuVisitor implements Visitor
{
	public function visit(NodeInterface $node)
	{
		if($node->isLeaf() && !$node->isRoot()){
			$value = $node->getValue();
			if(!isset($value['url'])){
				throw new InvalidConfigException('Param `url` must be set :'.$value['label']);
			}
			return [Html::tag('li',Html::a($value['label'],isset($value['url'])?$value['url']:'',['target'=>isset($value['target'])?$value['target']:'navTab','rel'=>static::generateId($value['label'])]))];
		}
		$yield = [];

		if(!$node->isRoot()){
			$yield = array_merge($yield, ['<li><a>'.$node->getValue()['label'].'</a>']);
		}
		$yield = array_merge($yield, ['<ul>']);
		foreach ($node->getChildren() as $child) {
			$yield = array_merge($yield, $child->accept($this));
		}
		$yield = array_merge($yield, ['</ul>']);
		if(!$node->isRoot()){
			$yield = array_merge($yield, ['</li>']);
		}
		return $yield;
	}
	public static function generateId($label){
		return sha1($label);
	}
}
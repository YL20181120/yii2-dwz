<?php
namespace yii\dwz;
use yii\dwz\tree\Visitor\Visitor;
use yii\helpers\Html;
use yii\helpers\Url;
/**
* 
*/
class TreeVisitor implements Visitor
{
	/**
     * {@inheritdoc}
     */
	public function visit(\yii\dwz\tree\Node\NodeInterface $node) {
		if ($node->isLeaf()) {
			$value = $node->getValue();
            return [Html::tag('li',Html::a($value['label'],$value['url'],['target'=>'navTab','rel'=>static::generateId($value['label'])]))];
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
		return '_'.crc32($label);
	}
}
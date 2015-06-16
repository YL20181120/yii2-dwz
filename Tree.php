<?php
namespace yii\dwz;
use yii\dwz\tree\Node\Node;
use yii\dwz\tree\Builder\NodeBuilder;
use yii\dwz\tree\Node\NodeInterface;
use yii\dwz\TreeVisitor;
/**
* 
*/
class Tree extends Widget
{
	public $items = [];
	protected $root;
	protected $nodebuilder;
	public function init(){
		$this->nodebuilder = new NodeBuilder();
		$this->nodebuilder->value('root');
		$this->initTree($this->items,$this->nodebuilder);
		$this->root = $this->nodebuilder->getNode();
	}
	public function run(){
		$this->getHtmlCode();
		return $this->html;
	}
	protected function initTree($items,&$root){
		foreach ($items as $v) {
			if(isset($v['visable']) && !$v['visable']){
				continue;
			}
			if(isset($v['menus']) && $v['menus']){
				$_t = $v['menus'];
				unset($v['menus']);
				\Yii::$app->mylog->doLog($v);
				$tree = $root->tree($v);
				$this->initTree($_t,$tree);
				$tree->end();
				continue;
			}
			\Yii::$app->mylog->doLog($v);
			$root->leaf($v);
		}
	}
	public function getHtmlCode(){
		$visitor = new TreeVisitor();

		return $this->root->accept($visitor);
	}
}
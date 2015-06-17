<?php
namespace yii\dwz;
use yii\helpers\Html;
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
		return $this->getHtmlCode();
	}
	protected function initTree($items,&$root){
		foreach ($items as $v) {
			if(isset($v['visible']) && !$v['visible']){
				continue;
			}
			if(isset($v['menus']) && $v['menus']){
				$_t = $v['menus'];
				unset($v['menus']);
				$tree = $root->tree($v);
				$this->initTree($_t,$tree);
				$tree->end();
				continue;
			}
			$root->leaf($v);
		}
	}
	public function getHtmlCode(){
		$visitor = new TreeVisitor();

		$res = $this->root->accept($visitor);
		if(!isset($this->options['class']))
			$this->options['class'] = 'tree treeFolder';
		$res[0] = Html::beginTag('ul',$this->options);
		$res = implode('', $res);
		return $res;
	}
}
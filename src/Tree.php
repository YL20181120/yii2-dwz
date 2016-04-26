<?php
/**
 * Created by Jasmine2.
 * FileName: Tree.php
 * Date: 2016-4-26
 * Time: 11:03
 */

namespace jasmine2\dwz;

use jasmine2\dwz\helpers\Html;
use jasmine2\dwz\trees\builder\NodeBuilder;
use jasmine2\dwz\trees\visitor\MenuVisitor;
class Tree extends Widget
{
	public $items = [];
	protected $root;
	protected $nodeBuilder;
	public function init(){
		$this->nodeBuilder = new NodeBuilder();
		$this->nodeBuilder->value('root');
		$this->createTree($this->items,$this->nodeBuilder);
		$this->root = $this->nodeBuilder->getNode();
	}
	public function run(){
		return $this->getHtmlCode();
	}
	protected function createTree($items,NodeBuilder &$root){
		foreach ($items as $v) {
			if(isset($v['visible']) && $v['visible'] == false){
				continue;
			}
			if(isset($v['label']) && isset($v['url'])){
				$root->leaf($v);
			} elseif(isset($v['menus'])){
				$menus = [
					'label' => $v['label'],
				];
				$tree = $root->tree($menus);
				$this->createTree($v['menus'], $tree);
				$tree->end();
			}
		}
	}
	public function getHtmlCode(){
		$visitor = new MenuVisitor();
		$res = $this->root->accept($visitor);
		//Html::addCssClass($this->options,['tree','treeFolder']);
		$res[0] = Html::beginTag('ul',$this->options);
		$res = implode('', $res);
		return $res;
	}
}
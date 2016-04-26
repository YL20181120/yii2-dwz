<?php
/**
 * Created by Jasmine2.
 * FileName: YieldVisitor.php
 * Date: 2016-4-26
 * Time: 10:36
 */

namespace jasmine2\dwz\trees\visitor;

use jasmine2\dwz\trees\node\NodeInterface;
class YieldVisitor implements Visitor
{
	/**
	 * {@inheritdoc}
	 */
	public function visit(NodeInterface $node)
	{
		if ($node->isLeaf()) {
			return [$node];
		}
		$yield = [];
		foreach ($node->getChildren() as $child) {
			$yield = array_merge($yield, $child->accept($this));
		}
		return $yield;
	}
}
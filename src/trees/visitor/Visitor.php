<?php
/**
 * Created by Jasmine2.
 * FileName: Visitor.php
 * Date: 2016-4-26
 * Time: 10:36
 */

namespace jasmine2\dwz\trees\visitor;


use jasmine2\dwz\trees\node\NodeInterface;

interface Visitor
{
	/**
	 * @param NodeInterface $node
	 * @return mixed
	 */
	public function visit(NodeInterface $node);
}
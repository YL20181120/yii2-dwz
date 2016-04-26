<?php

/**
 * Created by Jasmine2.
 * FileName: NodeBuilder.php
 * Date: 2016-4-26
 * Time: 10:37
 */

namespace jasmine2\dwz\trees\builder;

use jasmine2\dwz\trees\node\NodeInterface;
use jasmine2\dwz\trees\node\Node;
class NodeBuilder implements NodeBuilderInterFace
{
	/**
	 * @var array[NodeInterface]
	 */
	private $nodeStack = [];
	/**
	 * @param NodeInterface $node
	 */
	public function __construct(NodeInterface $node = null)
	{
		$this->setNode($node ?: $this->nodeInstanceByValue());
	}
	/**
	 * {@inheritdoc}
	 */
	public function setNode(NodeInterface $node)
	{
		$this
			->emptyStack()
			->pushNode($node)
		;
		return $this;
	}
	/**
	 * {@inheritdoc}
	 */
	public function getNode()
	{
		return $this->nodeStack[count($this->nodeStack) - 1];
	}
	/**
	 * {@inheritdoc}
	 */
	public function leaf($value = null)
	{
		$this->getNode()->addChild(
			$this->nodeInstanceByValue($value)
		);
		return $this;
	}
	/**
	 * {@inheritdoc}
	 */
	public function leafs($value1 /*,  $value2, ... */)
	{
		foreach (func_get_args() as $value) {
			$this->leaf($value);
		}
		return $this;
	}
	/**
	 * {@inheritdoc}
	 */
	public function tree($value = null)
	{
		$node = $this->nodeInstanceByValue($value);
		$this->getNode()->addChild($node);
		$this->pushNode($node);
		return $this;
	}
	/**
	 * {@inheritdoc}
	 */
	public function end()
	{
		$this->popNode();
		return $this;
	}
	/**
	 * {@inheritdoc}
	 */
	public function nodeInstanceByValue($value = null)
	{
		return new Node($value);
	}
	/**
	 * {@inheritdoc}
	 */
	public function value($value)
	{
		$this->getNode()->setValue($value);
		return $this;
	}
	private function emptyStack()
	{
		$this->nodeStack = [];
		return $this;
	}
	private function pushNode(NodeInterface $node)
	{
		array_push($this->nodeStack, $node);
		return $this;
	}
	private function popNode()
	{
		return array_pop($this->nodeStack);
	}
}
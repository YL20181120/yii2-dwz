<?php
/**
 * Created by Jasmine2.
 * FileName: DwzPager.php
 * Date: 2016-4-28
 * Time: 17:10
 */

namespace jasmine2\dwz\widgets;


use yii\widgets\LinkPager;
use jasmine2\dwz\helpers\Html;
class DwzPager extends LinkPager
{
	public $options = ['class' => 'panelBar'];
	public $target  = 'navTab';
	public $count   = 0;
	public $pageNumShow = 10;

	public $selects = [50,100,150,200,300];
	public function renderPageButtons()
	{
		$pageCount = $this->pagination->getPageCount();
		if ($pageCount < 2 && $this->hideOnSinglePage) {
			return '';
		}
		$numPerPage = $this->pagination->getPageSize();
		$pages = $this->renderPager($numPerPage);
		$option = [
			'class' 		=> 'pagination',
			'target'		=> $this->target,
			'totalCount' 	=> $this->count,
			'numPerPage'	=> $numPerPage,
			'pageNumShow'	=> $this->pageNumShow,
			'currentPage'	=> $this->pagination->getPage() + 1,
		];
		return Html::tag('div', $pages . Html::tag('div','',$option), $this->options);
	}


	public function renderPager($numPerPage){
		$_t1 = '<div class="pages">
			<span>显示</span>
			<select name="numPerPage" onchange="navTabPageBreak({numPerPage:this.value})">';
		$_t2 = '';
		foreach ($this->selects as $value) {
			$option = [
				'value' => $value,
			];
			if($value == $numPerPage){
				$option['selected'] = "selected";
			}
			$_t2 .= Html::tag('option',$value,$option);
		}
		$_t3 = '</select>
			<span>条，共'.$this->count.'条</span>
		</div>';
		return $_t1 . $_t2 . $_t3;
	}
}
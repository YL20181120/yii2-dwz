<?php
namespace yii\dwz;
use yii\widgets\LinkPager;
use yii\helpers\Html;
/**
* 
*/
class DwzPager extends LinkPager
{
	public $options = ['class' => 'panelBar'];
	public $target  = 'navTab';
	public $count = 0;
	public $pageNumShown = 10;
	protected function renderPageButtons()
    {
        $pageCount = $this->pagination->getPageCount();
        if ($pageCount < 2 && $this->hideOnSinglePage) {
            return '';
        }
        $pages = $this->renderPagers();
        $option = [
        	'class' 		=> 'pagination',
        	'target'		=> $this->target,
        	'totalCount' 	=> $this->count,
        	'numPerPage'	=> $this->pagination->getPageSize(),
        	'pageNumShown'	=> $this->pageNumShown,
        	'currentPage'	=> $this->pagination->getPage(),
        ];
        return Html::tag('div', $pages . Html::tag('div','',$option), $this->options);
    }

    protected function renderPagers(){
    	return '<div class="pages">
			<span>显示</span>
			<select name="numPerPage" onchange="navTabPageBreak({numPerPage:this.value})">
				<option value="20">20</option>
				<option value="50">50</option>
				<option value="100">100</option>
				<option value="200">200</option>
			</select>
			<span>条，共'.$this->count.'条</span>
		</div>';
    }
}
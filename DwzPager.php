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
        $numPerPage = $this->pagination->getPageSize();
        $pages = $this->renderPagers($numPerPage);
        $option = [
        	'class' 		=> 'pagination',
        	'target'		=> $this->target,
        	'totalCount' 	=> $this->count,
        	'numPerPage'	=> $numPerPage,
        	'pageNumShown'	=> $this->pageNumShown,
        	'currentPage'	=> $this->pagination->getPage() + 1,
        ];
        return Html::tag('div', $pages . Html::tag('div','',$option), $this->options);
    }

    protected function renderPagers($numPerPage){
    	$_t1 = '<div class="pages">
			<span>显示</span>
			<select name="numPerPage" onchange="navTabPageBreak({numPerPage:this.value})">';
            $_t2 = '';
				foreach ([20,50,100,200] as $value) {
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
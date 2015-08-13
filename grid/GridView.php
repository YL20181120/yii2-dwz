<?php
namespace yii\dwz\grid;
use Yii;
use yii\grid\GridView as Grid;
use yii\dwz\grid\DataColumn;
use yii\dwz\DwzPager;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\dwz\Pagination;
use yii\dwz\data\Sort;
class GridView extends Grid
{
    public $showPager = true;
    public $target = 'id';
	public $searchForm = [];
    public $layoutH = 100;
	public $sortColumns = false;
	public $summary = true;
    public $tableOptions = ['class' => 'list','style' => 'width:100%;','asc'=>'asc','desc'=>'desc'];

    public $filterPosition = self::FILTER_POS_HEADER;
	public function init(){
		parent::init();
        $this->tableOptions['layoutH'] = $this->layoutH;
        $this->layout = "<div id='w_list_print'>{summary}\n{items}\n{pager}</div>";
        $this->options['class'] = 'pageContent';
		$pagination = new Pagination();
		$this->dataProvider->setPagination($pagination);
        $this->dataProvider->setSort(new Sort());
	}
	public function renderSummary(){
		if($this->summary){
			$form = ActiveForm::begin(['id'=>'pagerForm','method'=>'post','options'=>['onsubmit' => 'return navTabSearch(this);']]);
			echo '<input type="hidden" name="pageNum" value="1" />';
			echo '<input type="hidden" name="numPerPage" value="'.$this->dataProvider->getPagination()->getPageSize().'"/>';
			echo '<input type="hidden" name="orderField" value="${param.orderField}" />';
			echo '<input type="hidden" name="orderDirection" value="${param.orderDirection}" />';
			ActiveForm::end();
		} else {
			return null;
		}
	}
    protected function createDataColumn($text,$options = [])
    {
        if (!preg_match('/^([^:]+)(:(\w*))?(:(.*))?$/', $text, $matches)) {
            throw new InvalidConfigException('The column must be specified in the format of "attribute", "attribute:format" or "attribute:format:label"');
        }
        if($this->sortColumns) {
            if(in_array($matches[1], $this->sortColumns))
                $options['headerOptions'] = [
                    'orderfield' => $matches[1],
                    'class' => 'desc',
                ];
        }
        return Yii::createObject(array_merge([
            'class' => $this->dataColumnClass ? : DataColumn::className(),
            'grid' => $this,
            'attribute' => $matches[1],
            'format' => isset($matches[3]) ? $matches[3] : 'text',
            'label' => isset($matches[5]) ? $matches[5] : null,
        ],$options));
    }
	protected function initColumns(){
        if (empty($this->columns)) {
            $this->guessColumns();
        }
        foreach ($this->columns as $i => $column) {
            if (is_string($column)) {
                $column = $this->createDataColumn($column);
            } else {
                $column = Yii::createObject(array_merge([
                    'class' => $this->dataColumnClass ? : DataColumn::className(),
                    'grid' => $this,
                ], $column));
            }
            if (!$column->visible) {
                unset($this->columns[$i]);
                continue;
            }
            $this->columns[$i] = $column;
        }		
	}
	public function renderPager(){
        if(!$this->showPager){
            return '';
        }
		$pagination = $this->dataProvider->getPagination();
        if ($pagination === false || $this->dataProvider->getCount() <= 0) {
            return '';
        }
		$pager = $this->pager;
        $class = ArrayHelper::remove($pager, 'class', DwzPager::className());
        $pager['pagination'] = $pagination;
        $pager['view'] = $this->getView();
        $pager['count']= $this->dataProvider->getTotalCount();
        return $class::widget($pager);
	}

    public function renderTableRow($model, $key, $index)
    {
        $cells = [];
        /* @var $column Column */
        foreach ($this->columns as $column) {
            $cells[] = $column->renderDataCell($model, $key, $index);
        }
        if ($this->rowOptions instanceof \Closure) {
            $options = call_user_func($this->rowOptions, $model, $key, $index, $this);
        } else {
            $options = $this->rowOptions;
        }
        $options['rel'] = is_array($key) ? json_encode($key) : (string) $key;
        $options['target'] = $this->target;
        return Html::tag('tr', implode('', $cells), $options);
    }    
}

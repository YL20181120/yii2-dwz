<?php
namespace jasmine2\dwz\grid;
/**
 * Created by Jasmine2.
 * FileName: GridView.php
 * Date: 2016-4-28
 * Time: 11:01
 */
use Yii;
use jasmine2\dwz\grid\DataColumn;
use jasmine2\dwz\helpers\Html;
use jasmine2\dwz\helpers\ArrayHelper;
use yii\base\InvalidConfigException;
use jasmine2\dwz\data\Pagination;
use jasmine2\dwz\widgets\DwzPager;
use yii\widgets\ActiveForm;
/**
 * Class GridView
 * @package jasmine2\dwz\grid
 * @property $dataProvider \yii\data\ActiveDataProvider
 */
class GridView extends \yii\grid\GridView
{
	public $layoutH = 55;
	public $tableOptions = [
		'class' => 'table',
		'width' => '100%',
		'asc'=>'asc',
		'desc'=>'desc'
	];

	public $options = ['class' => ''];
	public function init()
	{
		parent::init();
		$this->tableOptions['layoutH'] = $this->layoutH;
		$this->layout = "\n{items}\n{summary}\n{pager}";
		Html::addCssClass($this->options, 'pageContent');
		$this->summary = true;
		$pagination = new Pagination();
		$this->dataProvider->setPagination($pagination);
	}

	public function run()
	{
		if ($this->showOnEmpty || $this->dataProvider->getCount() > 0) {
			$content = preg_replace_callback("/{\\w+}/", function ($matches) {
				$content = $this->renderSection($matches[0]);

				return $content === false ? $matches[0] : $content;
			}, $this->layout);
		} else {
			$content = $this->renderEmpty();
		}

		$options = $this->options;
		$tag = ArrayHelper::remove($options, 'tag', 'div');
		echo Html::tag($tag, $content, $options);
	}



	public function renderSummary()
	{
		if($this->summary){
			echo '<form id="pagerForm" method="post" onsubmit="return navTabSearch(this)">';
			echo '<input type="hidden" name="pageNum" value="1" />';
			echo '<input type="hidden" name="'.Yii::$app->request->csrfParam.'" value="'.Yii::$app->request->getCsrfToken().'" />';
			echo '<input type="hidden" name="numPerPage" value="'.$this->dataProvider->getPagination()->getPageSize().'"/>';
			echo '<input type="hidden" name="orderField" value="${param.orderField}" />';
			echo '<input type="hidden" name="orderDirection" value="${param.orderDirection}" />';
			Html::endForm();
		} else {
			return null;
		}
	}

	public function renderPager()
	{
		$pagination = $this->dataProvider->getPagination();
		if ($pagination === false || $this->dataProvider->getCount() <= 0) {
			return '';
		}
		$pager = $this->pager;
		$class = ArrayHelper::remove($pager, 'class', DwzPager::className());
		$pager['pagination'] = $pagination;
		$pager['view'] = $this->getView();
		$pager['count']= $this->dataProvider->getTotalCount();
		return $class::widget($pager,['dataProvider' => $this->dataProvider]);
	}

	protected function createDataColumn($text)
	{
		if (!preg_match('/^([^:]+)(:(\w*))?(:(.*))?$/', $text, $matches)) {
			throw new InvalidConfigException('The column must be specified in the format of "attribute", "attribute:format" or "attribute:format:label"');
		}

		return Yii::createObject([
			'class' => $this->dataColumnClass ? : DataColumn::className(),
			'grid' => $this,
			'attribute' => $matches[1],
			'format' => isset($matches[3]) ? $matches[3] : 'text',
			'label' => isset($matches[5]) ? $matches[5] : null,
		]);
	}

	protected function initColumns()
	{
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
}
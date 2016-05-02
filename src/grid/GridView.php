<?php
namespace jasmine2\dwz\grid;
/**
 * Created by Jasmine2.
 * FileName: GridView.php
 * Date: 2016-4-28
 * Time: 11:01
 */
use jasmine2\dwz\helpers\Html;
use jasmine2\dwz\helpers\ArrayHelper;
use Yii;
use yii\helpers\Url;
use yii\widgets\BaseListView;
use yii\base\InvalidConfigException;
use yii\i18n\Formatter;
use jasmine2\dwz\widgets\DwzPager;
use jasmine2\dwz\data\Pagination;
use jasmine2\dwz\data\Sort;
use yii\widgets\ActiveForm;
/**
 * Class GridView
 * @package jasmine2\dwz\grid
 * @property $dataProvider \yii\data\ActiveDataProvider
 */
class GridView extends BaseListView
{
	public $layoutH = '48';
	public $options = ['class' => 'pageContent'];
	public $columns = [];
	public $showTools = true;
	public $tools   = [
		'create',
		'update',
		'delete',
	];
	public $tableOptions = ['class' => 'table','width' => '100%'];
	public $rowOptions = [];
	public $rowTarget = 'row_id';
	public $headerRowOptions = [];
	public $formatter;
	public $emptyCell = '&nbsp;';

	public $layout = "{pagerForm}\n{search}\n{tools}\n{items}\n{pager}";

	public function init()
	{
		parent::init();
		if ($this->formatter === null) {
			$this->formatter = Yii::$app->getFormatter();
		} elseif (is_array($this->formatter)) {
			$this->formatter = Yii::createObject($this->formatter);
		}
		if (!$this->formatter instanceof Formatter) {
			throw new InvalidConfigException('The "formatter" property must be either a Format object or a configuration array.');
		}
		$this->initColumns();
		$this->dataProvider->setPagination(new Pagination());
	}

	protected function initColumns(){
		if (empty($this->columns)) {
			$this->guessColumns();
		}
		foreach ($this->columns as $index => $column) {
			if(is_string($column)){
				$column = $this->createDataColumn($column);
			} else {
				$column = Yii::createObject(array_merge([
					'class' => DataColumn::className(),
					'grid' => $this,
				], $column));
			}
			if (!$column->visible) {
				unset($this->columns[$index]);
				continue;
			}
			$this->columns[$index] = $column;
		}
	}
	public function run()
	{
		parent::run();
	}

	public function renderItems()
	{
		$search = $this->renderSearch();
		$tableHeader = $this->renderTableHeader();
		$tableBody = $this->renderTableBody();
		$content = array_filter([
			$tableHeader,
			$tableBody,
		]);
		$this->tableOptions['layoutH'] = $this->layoutH;
		return Html::tag('table', implode("\n", $content), $this->tableOptions);
	}
	public function renderTableHeader(){
		$cells = [];
		foreach ($this->columns as $column) {
			/* @var $column Column */
			$cells[] = $column->renderHeaderCell();
		}
		$content = Html::tag('tr', implode('', $cells), $this->headerRowOptions);

		return "<thead>\n" . $content . "\n</thead>";
	}
	public function renderTableBody(){
		$models = array_values($this->dataProvider->getModels());
		$keys = $this->dataProvider->getKeys();
		$rows = [];
		foreach ($models as $index => $model) {
			$key = $keys[$index];
			$rows[] = $this->renderTableRow($model, $key, $index);
		}

		if (empty($rows)) {
			$colspan = count($this->columns);
			return "<tbody>\n<tr><td colspan=\"$colspan\">" . $this->renderEmpty() . "</td></tr>\n</tbody>";
		} else {
			return "<tbody>\n" . implode("\n", $rows) . "\n</tbody>";
		}
	}
	public function renderTableRow($model, $key, $index)
	{
		$cells = [];
		/* @var $column Column */
		foreach ($this->columns as $column) {
			$cells[] = $column->renderDataCell($model, $key, $index);
		}
		if ($this->rowOptions instanceof Closure) {
			$options = call_user_func($this->rowOptions, $model, $key, $index, $this);
		} else {
			$options = $this->rowOptions;
		}
		$options['rel'] = is_array($key) ? json_encode($key) : (string) $key;
		$options['target'] = $this->rowTarget;

		return Html::tag('tr', implode('', $cells), $options);
	}
	public function renderPager()
	{
		$pagination = $this->dataProvider->getPagination();

		if ($pagination === false || $this->dataProvider->getCount() <= 0) {
			return '';
		}
		/* @var $class LinkPager */
		$pager = $this->pager;
		$class = ArrayHelper::remove($pager, 'class', DwzPager::className());
		$pager['pagination'] = $pagination;
		$pager['count'] = $this->dataProvider->getTotalCount();
		return $class::widget($pager);
	}

	public function renderTools()
	{
		if($this->showTools) {
			$this->layoutH += 27;
			echo Html::beginTag('div',['class' => 'panelBar']);
			echo Html::beginTag('ul',['class' => 'toolBar']);
			foreach($this->tools as $tool){
				if(is_string($tool)){
					switch($tool){
						case 'create':
							echo Html::tag('li',Html::a('<span>添加</span>',[Yii::$app->controller->uniqueId . '/create'],['class' => 'add','target' => 'navTab']));
							break;
						case 'update':
							echo Html::tag('li',Html::a('<span>编辑</span>',[Yii::$app->controller->uniqueId . '/update&id={row_id}'],['class' => 'edit','target' => 'navTab']));
							break;
						case 'delete':
							echo Html::tag('li',Html::a('<span>删除</span>',
								[Yii::$app->controller->uniqueId . '/delete&id={row_id}'],
								[
									'class' => 'delete',
									'target' => 'ajaxTodo',
									'title' => '确定要删除吗？',
									'_csrf' => Yii::$app->request->getCsrfToken()]));
							break;
						default:
							break;
					}
				}
			}
			echo Html::endTag('ul');
			echo Html::endTag('div');
		}
	}

	public function renderSection($name)
	{
		switch ($name) {
			case '{search}':
				return $this->renderSearch();
			case '{tools}':
				return $this->renderTools();
			case '{pagerForm}':
				return $this->renderPagerForm();
			default:
				return parent::renderSection($name);
		}
	}

	public function renderPagerForm(){
		$pagination = $this->dataProvider->getPagination();
		ActiveForm::begin(['id' => 'pagerForm','enableClientScript' => false]);
		echo Html::input('hidden','pageNum',1);
		echo Html::input('hidden','numPerPage',$pagination->getPageSize());
		ActiveForm::end();
	}
	public function renderSearch()
	{
		return '';
	}


	public function guessColumns()
	{
		$models = $this->dataProvider->getModels();
		$model = reset($models);
		if (is_array($model) || is_object($model)) {
			foreach ($model as $name => $value) {
				$this->columns[] = (string) $name;
			}
		}
	}
	/**
	 * Creates a [[DataColumn]] object based on a string in the format of "attribute:format:label".
	 * @param string $text the column specification string
	 * @return DataColumn the column instance
	 * @throws InvalidConfigException if the column specification is invalid
	 */
	protected function createDataColumn($text)
	{
		if (!preg_match('/^([^:]+)(:(\w*))?(:(.*))?$/', $text, $matches)) {
			throw new InvalidConfigException('The column must be specified in the format of "attribute", "attribute:format" or "attribute:format:label"');
		}
		return Yii::createObject([
			'class' => DataColumn::className(),
			'grid' => $this,
			'attribute' => $matches[1],
			'format' => isset($matches[3]) ? $matches[3] : 'text',
			'label' => isset($matches[5]) ? $matches[5] : null,
		]);
	}
}
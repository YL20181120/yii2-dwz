<?php
namespace jasmine2\dwz\grid;
/**
 * Created by Jasmine2.
 * FileName: GridView.php
 * Date: 2016-4-28
 * Time: 11:01
 */
use jasmine2\dwz\Dialog;
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
	public $search = null;
	public $showTools = true;
	public $tools   = [
		'view',
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

	public $layout = "{search}\n{pagerForm}\n{tools}\n{items}\n{pager}";

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
		$content = preg_replace_callback("/{\\w+}/", function ($matches) {
			$content = $this->renderSection($matches[0]);

			return $content === false ? $matches[0] : $content;
		}, $this->layout);

		$options = $this->options;
		$tag = ArrayHelper::remove($options, 'tag', 'div');
		echo Html::tag($tag, $content, $options);
	}
	public function renderEmpty(){
		return '无内容';
	}
	public function renderItems()
	{
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
			return "<tbody>\n<tr><td colspan=\"$colspan\" style='text-align: center;'>" . $this->renderEmpty() . "</td></tr>\n</tbody>";
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
			$tools = [];
			$tools[] = Html::beginTag('div',['class' => 'panelBar']);
			$tools[] = Html::beginTag('ul',['class' => 'toolBar']);
			foreach($this->tools as $tool){
				if(is_string($tool)){
					switch($tool){
						case 'create':
							$tools[] = Html::tag('li',Html::a('<span>添加</span>',[Yii::$app->controller->uniqueId . '/create'],['class' => 'add','target' => 'navTab']));
							break;
						case 'update':
							$tools[] = Html::tag('li',Html::a('<span>编辑</span>',[Yii::$app->controller->uniqueId . '/update?id={row_id}'],['class' => 'edit','target' => 'navTab']));
							break;
						case 'delete':
							$tools[] = Html::tag('li',Html::a('<span>删除</span>',
								[Yii::$app->controller->uniqueId . '/delete?id={row_id}'],
								[
									'class' => 'delete',
									'target' => 'ajaxTodo',
									'title' => Yii::t('yii', 'Are you sure you want to delete this item?'),
									'_csrf' => Yii::$app->request->getCsrfToken()
								]));
							break;
						case 'view':
							$tools[] = Html::tag('li', Dialog::widget([
								'title' => '查看',
								'mask'  => true,
								'text'  => '<span>查看</span>',
								'options' => [
									'class' => 'icon',
								],
								'url'   => [Yii::$app->controller->uniqueId . '/view?id={row_id}']
							]));
							/*$tools[] = Html::tag('li',Html::a(
								'<span>查看</span>',
								[Yii::$app->controller->uniqueId . '/view?id={row_id}'],
								[
									'target' => 'navTab',
									'class' => 'icon',
								]
							));*/
							break;
						default:
							$tools[] = $tool;
					}
				}
			}
			$tools[] = Html::endTag('ul');
			$tools[] = Html::endTag('div');
			return implode('',$tools);
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

	public function renderSearch()
	{
		if($this->search){
			$this->layoutH += 62;
			return $this->search;
		}
	}
}
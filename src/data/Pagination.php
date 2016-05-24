<?php
/**
 * Created by Jasmine2.
 * FileName: Pagination.php
 * Date: 2016-4-28
 * Time: 16:44
 */

namespace jasmine2\dwz\data;

use Yii;
use yii\web\Request;

class Pagination extends \yii\data\Pagination
{
	public $pageSizeParam   = 'numPerPage';
	public $pageParam       = 'pageNum';
	public $defaultPageSize = 50;
	public $pageSizeLimit   = [1,300];

	/**
	 * 为了从post中获取分页数据
	 * @param string $name
	 * @param null $defaultValue
	 * @return null
	 */
	protected function getQueryParam($name, $defaultValue = null)
	{
		if (($params = $this->params) === null) {
			$request = Yii::$app->getRequest();
			$params = $request instanceof Request ? $request->post() : [];
		}
		return isset($params[$name]) && is_scalar($params[$name]) ? $params[$name] : $defaultValue;
	}
}
<?php
namespace jasmine2\dwz\grid;
/**
 * Created by Jasmine2.
 * FileName: ActionColumn.php
 * Date: 2016-4-28
 * Time: 11:01
 */
use jasmine2\dwz\helpers\Html;
use Yii;
class ActionColumn extends \yii\grid\ActionColumn
{
	public function initDefaultButtons(){
		if (!isset($this->buttons['view'])) {
			$this->buttons['view'] = function ($url, $model, $key) {
				$options = array_merge([
					'title' => Yii::t('yii', 'View'),
					'target'=> 'navTab',
					'class' => 'btnView'
				], $this->buttonOptions);
				return Html::a(Yii::t('yii', 'View'), $url, $options);
			};
		}
		if (!isset($this->buttons['update'])) {
			$this->buttons['update'] = function ($url, $model, $key) {
				$options = array_merge([
					'title' => Yii::t('yii', 'Update'),
					'target'=> 'navTab',
					'class' => 'btnEdit'
				], $this->buttonOptions);
				return Html::a(Yii::t('yii', 'Update'), $url, $options);
			};
		}
		if (!isset($this->buttons['delete'])) {
			$this->buttons['delete'] = function ($url, $model, $key) {
				$options = array_merge([
					'target'=> 'ajaxTodo',
					'class' => 'btnDel',
					'_csrf' => Yii::$app->request->getCsrfToken(),
					'title' => Yii::t('yii', 'Are you sure you want to delete this item?'),
				], $this->buttonOptions);
				return Html::a(Yii::t('yii', 'Delete'), $url, $options);
			};
		}
	}
}
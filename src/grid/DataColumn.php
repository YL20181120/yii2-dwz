<?php
namespace jasmine2\dwz\grid;
use jasmine2\dwz\helpers\Html;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQueryInterface;
use yii\helpers\Inflector;
/**
 * Created by Jasmine2.
 * FileName: DataColumn.php
 * Date: 2016-4-28
 * Time: 11:02
 */
class DataColumn extends \yii\grid\DataColumn
{
	public function renderHeaderCell()
	{
		$options = [];
		$dataProvider = $this->grid->dataProvider;

		if($this->attribute !== null && $this->enableSorting && false){

		} else {
			return Html::tag('th',$this->renderHeaderCellContent(),$options);
		}
	}

	public function renderHeaderCellContent()
	{
		if ($this->header !== null || $this->label === null && $this->attribute === null) {
			return parent::renderHeaderCellContent();
		}

		$dataProvider = $this->grid->dataProvider;

		if($this->label === null){
			if($dataProvider instanceof ActiveDataProvider && $dataProvider->query instanceof ActiveQueryInterface){
				$model = new $dataProvider->query->modelClass;
				$label = $model->getAttributeLabel($this->attribute);
			} else {
				$models = $dataProvider->getModels();
				if (($model = reset($models)) instanceof Model) {
					/* @var $model Model */
					$label = $model->getAttributeLabel($this->attribute);
				} else {
					$label = Inflector::camel2words($this->attribute);
				}
			}
		} else {
			$label = $this->label;
		}
		return $this->encodeLabel ? Html::encode($label):$label;
	}

}
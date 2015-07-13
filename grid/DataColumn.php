<?php
namespace yii\dwz\grid;
use yii\helpers\Inflector;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQueryInterface;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
/**
* 
*/
class DataColumn extends \yii\grid\DataColumn
{
	public function renderHeaderCellContent(){
		if ($this->header !== null || $this->label === null && $this->attribute === null) {
            return parent::renderHeaderCellContent();
        }
		$provider = $this->grid->dataProvider;

        if ($this->label === null) {
            if ($provider instanceof ActiveDataProvider && $provider->query instanceof ActiveQueryInterface) {
                /* @var $model Model */
                $model = new $provider->query->modelClass;
                $label = $model->getAttributeLabel($this->attribute);
            } else {
                $models = $provider->getModels();
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
        return $this->encodeLabel ? Html::encode($label) : $label;
	}
    public function renderHeaderCell()
    {
    	$options = [];
		$provider = $this->grid->dataProvider;

        if ($this->attribute !== null && $this->enableSorting &&
            ($sort = $provider->getSort()) !== false && $sort->hasAttribute($this->attribute)) {
            return $this->createSort($this->attribute,$sort,$this->headerOptions);
        } else {
	        return Html::tag('th', $this->renderHeaderCellContent(), $options);
        }
    }
	protected function createSort($attribute,$sort,$options = []){
		if (($direction = $sort->getAttributeOrder($attribute)) !== null) {
            $class = $direction === SORT_DESC ? 'desc' : 'asc';
            if (isset($options['class'])) {
                $options['class'] .= ' ' . $class;
            } else {
                $options['class'] = $class;
            }
        } else {
        	$options['class'] = 'asc';
        }
        $options['orderfield'] = $attribute;
        return Html::tag('th',$this->renderHeaderCellContent(),$options);
	}
	public function getDataCellValue($model, $key, $index)
    {
        if ($this->value !== null) {
            if (is_string($this->value)) {
                return ArrayHelper::getValue($model, $this->value);
            } else {
                return call_user_func($this->value, $model, $key, $index, $this);
            }
        } elseif ($this->attribute !== null) {
            return ArrayHelper::getValue($model, $this->attribute);
        }
        return null;
    }

    /**
     * @inheritdoc
     */
    protected function renderDataCellContent($model, $key, $index)
    {
        if ($this->content === null) {
            return $this->grid->formatter->format($this->getDataCellValue($model, $key, $index), $this->format);
        } else {
            return parent::renderDataCellContent($model, $key, $index);
        }
    }
    public function renderFilterCell()
    {
        return Html::tag('td', $this->renderFilterCellContent(), $this->filterOptions);
    }
    protected function renderFilterCellContent()
    {
        if (is_string($this->filter)) {
            return $this->filter;
        }

        $model = $this->grid->filterModel;

        if ($this->filter !== false && $model instanceof Model && $this->attribute !== null && $model->isAttributeActive($this->attribute)) {
            if ($model->hasErrors($this->attribute)) {
                Html::addCssClass($this->filterOptions, 'error');
                $error = ' ' . Html::error($model, $this->attribute, $this->grid->filterErrorOptions);
            } else {
                $error = '';
            }
            if (is_array($this->filter)) {
                $options = array_merge(['prompt' => ''], $this->filterInputOptions);
                return Html::activeDropDownList($model, $this->attribute, $this->filter, $options) . $error;
            } else {
                return Html::activeTextInput($model, $this->attribute, $this->filterInputOptions) . $error;
            }
        } else {
            return parent::renderFilterCellContent();
        }
    }
}
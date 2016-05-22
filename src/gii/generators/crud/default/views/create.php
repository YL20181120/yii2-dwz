<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

echo "<?php\n";
?>

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$this->title = <?= $generator->generateString('Create ' . Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>;
?>
<h2 class="contentTitle"><?= "<?= " ?> $this->title ?></h2>
<div class="pageContent">
    <?= "<?= " ?>$this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php
/**
 * Created by Jasmine2.
 * FileName: login.php
 * Date: 2016-5-16
 * Time: 22:46
 */
use jasmine2\dwz\LoginAsset;
use jasmine2\dwz\helpers\Html;
LoginAsset::register($this);
$assetUrl = $this->getAssetManager()->getBundle(LoginAsset::className())->baseUrl;
?>
<!DOCTYPE HTML>
<?php $this->beginPage()?>
<html lang="<?= Yii::$app->language?>">
<head>
	<meta charset="<?= Yii::$app->charset ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?= Html::csrfMetaTags() ?>
	<title><?= Html::encode($this->title)?></title>
	<?php $this->head()?>
</head>
<body>
<?php $this->beginBody() ?>
<?= $content?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage()?>

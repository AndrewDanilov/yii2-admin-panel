<?php

use yii\helpers\Html;
use andrewdanilov\adminpanel\assets\AdminPanelAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AdminPanelAsset::register($this);

if (isset(Yii::$app->params['siteName'])) {
	$siteName = Yii::$app->params['siteName'];
} else {
	$siteName = 'AdminPanel';
}
if (isset(Yii::$app->user->identity['username'])) {
	$userName = Yii::$app->user->identity['username'];
} else {
	$userName = 'Guest';
}
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/andrewdanilov/yii2-admin-panel/src');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="page-wrapper">

	<?= $this->render(
		'_blocks/left',
		['directoryAsset' => $directoryAsset, 'siteName' => $siteName]
	) ?>

	<div class="page-main">

		<?= $this->render(
			'_blocks/top',
			['directoryAsset' => $directoryAsset, 'userName' => $userName]
		) ?>

		<?= $this->render(
			'_blocks/content',
			['directoryAsset' => $directoryAsset, 'content' => $content]
		) ?>

		<?= $this->render(
			'_blocks/footer',
			['directoryAsset' => $directoryAsset]
		) ?>

	</div>

</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>


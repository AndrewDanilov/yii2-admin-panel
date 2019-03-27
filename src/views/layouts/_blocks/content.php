<?php

use yii\widgets\Breadcrumbs;

/* @var $content string */
/* @var $this \yii\web\View */
/* @var $directoryAsset false|string */

?>

<div class="page-content">

	<?= Breadcrumbs::widget(
		[
			'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
			'homeLink' => [
				'label' => 'Dashboard',
				'url' => Yii::$app->homeUrl,
			],
			'itemTemplate' => '<li class="breadcrumb-item">{link}</li>',
			'activeItemTemplate' => '<li class="breadcrumb-item active">{link}</li>',
		]
	) ?>

	<?= $content ?>

</div>
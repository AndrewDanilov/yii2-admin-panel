<?php

use andrewdanilov\adminpanel\Menu;

/* @var $this \yii\web\View */
/* @var $siteName string */
/* @var $directoryAsset false|string */

?>

<div class="page-left">
	<div class="sidebar-heading"><?= $siteName ?></div>
	<?= Menu::widget(['items' => [
		['label' => 'Dashboard', 'url' => ['/site/index'], 'icon' => 'tachometer-alt'],
		[],
		['label' => 'Блог'],
		['label' => 'Новости', 'url' => ['/news/index'], 'icon' => ['symbol' => 'newspaper', 'type' => 'regular']],
		['label' => 'Статьи', 'url' => ['/articles/index'], 'icon' => ['symbol' => 'newspaper', 'type' => 'solid']],
		[],
		['label' => 'Система'],
		['label' => 'Пользователи', 'url' => ['/user/index'], 'icon' => 'users'],
	]]) ?>
</div>

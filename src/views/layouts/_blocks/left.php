<?php

use andrewdanilov\sbadmin\Menu;

/* @var $this \yii\web\View */
/* @var $siteName string */
/* @var $directoryAsset false|string */

?>

<div class="page-left">
	<div class="sidebar-heading"><?= $siteName ?></div>
	<?= Menu::widget(['options' => ['class' => 'bg-gray-900 sidebar-dark', 'id' => 'accordionSidebar'], 'items' => [
		['label' => 'Dashboard', 'url' => ['site/index'], 'icon' => 'tachometer-alt'],
		[],
		['label' => 'Объявления'],
		['label' => 'Организации', 'url' => ['organization/index'], 'icon' => 'building'],
		['label' => 'Категории', 'url' => ['category/index'], 'icon' => 'tags'],
		['label' => 'Бренды', 'url' => ['brand/index'], 'icon' => 'leaf'],
		[],
		['label' => 'Система'],
		['label' => 'Аккаунты', 'url' => ['account/index'], 'icon' => 'users'],
	]]) ?>
</div>

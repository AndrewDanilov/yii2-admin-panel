<?php

namespace andrewdanilov\adminpanel;

use yii\web\AssetBundle;

class AdminPanelAsset extends AssetBundle
{
	public $sourcePath = '@vendor/andrewdanilov/yii2-admin-panel/src/web';
	public $css = [
		'css/style.css',
	];
	public $js = [
	];
	public $depends = [
		'yii\web\JqueryAsset',
		'yii\bootstrap\BootstrapAsset',
		'rmrevin\yii\fontawesome\CdnFreeAssetBundle',
	];
}
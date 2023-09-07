<?php
namespace andrewdanilov\adminpanel\assets;

use yii\web\AssetBundle;

class AdminPanelAsset extends AssetBundle
{
	public $sourcePath = '@andrewdanilov/adminpanel/web';
	public $css = [
		'css/style.css',
	];
	public $js = [
	];
	public $depends = [
		'yii\web\JqueryAsset',
		'yii\bootstrap5\BootstrapAsset',
		'andrewdanilov\gridtools\GridToolsAsset',
	];
}
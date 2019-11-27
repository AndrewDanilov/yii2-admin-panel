Admin Panel
===========
Simple Admin Panel template

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
composer require andrewdanilov/yii2-admin-panel "~1.0.0"
```

or add

```
"andrewdanilov/yii2-admin-panel": "~1.0.0"
```

to the require section of your `composer.json` file.


Usage
-----

Copy directory src/views to your backend views location, then modify templates in it to your needs.

In backend config place 'user' section inside 'components':

```php
<?php
$config = [
	// ...
	'components' => [
		// ...
		'user' => [
			'class' => 'yii\web\User',
			'identityClass' => 'common\models\User',
			'accessChecker' => 'andrewdanilov\adminpanel\AccessChecker',
			'enableAutoLogin' => true,
			'identityCookie' => ['name' => '_identity-common', 'httpOnly' => true],
			'loginUrl' => ['user/login'],
		],
	],
];
```

You can use your own access checker, therefore replace _accessChecker_ property value of _user_ component config above. Then copy __AccessChecker.php__ to your location and modify it, as you need.

To use default extension's controllers add 'controllerMap' section to your backend config:

```php
<?php
$config = [
	// ...
	'controllerMap' => [
		'user' => 'andrewdanilov\adminpanel\controllers\UserController',
	],
];
```

To make access control on all your admin pages working properly, you need to extend all your backend controllers from
andrewdanilov\adminpanel\controllers\BackendController

```php
<?php
use andrewdanilov\adminpanel\controllers\BackendController;

class AnyController extends BackendController
{
	// ...
}
```

Additionaly you can use FontawesomeActionColumn class in your GridViews instead of default ActionColumn, to replace default Bootstrap action icons with corresponding Fontawesome icons:

```php
<?php
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $searchModel \yii\db\ActiveRecord */
use yii\grid\GridView;
?>
<?= GridView::widget([
	'dataProvider' => $dataProvider,
	'filterModel' => $searchModel,
	'columns' => [
		'id',
		'name',
		[
			'class' => 'andrewdanilov\gridtools\FontawesomeActionColumn',
			'template' => '{update}{delete}',
		],
	],
]); ?>
```
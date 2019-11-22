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

Copy dir src/views to your backend views location, then modify it on your own.

In backend config place 'user' section under 'components':

```php
<?php
$config = [
    // ...
    'components' => [
        // ...
        'user' => [
			'class' => 'yii\web\User',
			'identityClass' => 'common\models\User',
			'accessChecker' => 'andrewdanilov\adminpanel\components\AccessChecker',
			'enableAutoLogin' => true,
			'identityCookie' => ['name' => '_identity-common', 'httpOnly' => true],
			'loginUrl' => ['user/login'],
		],
    ],
];
```

And than place 'controllerMap' section of your backend config:

```php
<?php
$config = [
    // ...
    'controllerMap' => [
        'user' => 'andrewdanilov\adminpanel\controllers\UserController',
    ],
];
```

Additionaly you can use FontawesomeActionColumn class in your grids views instead of default ActionColumn, to replace default Bootstrap action icons with corresponding Fontawesome icons:

```php
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
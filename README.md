Admin Panel
===========
Simple Admin Panel template and user accounts manager

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
composer require andrewdanilov/yii2-admin-panel "~2.0.0"
```

or add

```
"andrewdanilov/yii2-admin-panel": "~2.0.0"
```

to the `require` section of your `composer.json` file.

Then run db migrations, to modify needed tables:

```
php yii migrate --migrationPath=@andrewdanilov/adminpanel/migrations
```

Do not forget to run migrations after extension updates too.


Usage
-----

Copy directory `src/views` to your backend views location, then modify these templates to your needs.

In backend config place (or replace) `user` section inside `components`:

```php
$config = [
	// ...
	'components' => [
		// ...
		'user' => [
			'class' => 'yii\web\User',
			'identityClass' => 'andrewdanilov\adminpanel\models\User',
			'accessChecker' => 'andrewdanilov\adminpanel\AccessChecker',
			'enableAutoLogin' => true,
			'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
			'loginUrl' => ['user/login'],
		],
	],
];
```

Instead of default you can use your own access checker or user identity class, therefore replace correspondent _accessChecker_ or _identityClass_ properties of _user_ component within backend config. Then copy __src/AccessChecker.php__ if you replacing access checker and __src/models/User.php__ if you replacing identity class, and place them to your own location. Modify it, as you need. Do not forget to replace namespace definition of duplicated classes.

To use default extension's controllers add 'controllerMap' section to your backend config:

```php
$config = [
	// ...
	'controllerMap' => [
		'user' => [
			'class' => 'andrewdanilov\adminpanel\controllers\UserController',
			'viewPath' => '@backend/someotherlocation/views/user', // optional, custom UserController views location
		],
	],
];
```

If you use custom views location (and it is not default '@backend/views' or other location defined in backend config) with default extension's `UserController`, you need to set `viewPath` property in `controllerMap` section.

Default `UserController` already have CRUD methods for managing user accounts. Use this link to get access to them:

```php
use yii\helpers\Url;

$userManagerUrl = Url::to(['/user']);
```

To make access control on all your admin pages working properly, you need to extend all your backend controllers from
andrewdanilov\adminpanel\controllers\BackendController

```php
use andrewdanilov\adminpanel\controllers\BackendController;

class AnyController extends BackendController
{
	// ...
}
```

To make work it properly you must remove methods `behaviors` and `actions` from `AnyController` or extends that methods from parent class, just like so:

```php
use andrewdanilov\adminpanel\controllers\BackendController;

class AnyController extends BackendController
{
	// ...
	public function actions()
	{
		$actions = parent::actions();
		$actions['error']['layout'] = 'error';
		return $actions;
	}
	// ...
}
```

Additionaly you can use FontawesomeActionColumn class in your GridViews instead of default ActionColumn, to replace default Bootstrap action icons with corresponding Fontawesome icons:

```php
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
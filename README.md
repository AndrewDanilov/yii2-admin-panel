Admin Panel
===========
Simple Admin Panel

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
composer require andrewdanilov/yii2-admin-panel "dev-master"
```

or add

```
"andrewdanilov/yii2-admin-panel": "dev-master"
```

to the require section of your `composer.json` file.


Usage
-----

Copy dir src/views to your backend views location, then modify in on your own.

Additionaly you can use FontawesomeActionColumn class in your grids instead of default ActionColumn, to replace default Bootstrap action icons with corresponding Fontawesome icons.

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
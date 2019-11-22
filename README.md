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
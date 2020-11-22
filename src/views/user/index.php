<?php

/* @var $this \yii\web\View */
/* @var $searchModel UserSearch */
/* @var $dataProvider \yii\data\ActiveDataProvider */

$this->title = 'Пользователи';

use yii\grid\GridView;
use andrewdanilov\adminpanel\models\User;
use andrewdanilov\adminpanel\models\UserSearch;

?>

<div class="form-group">
	<?= \yii\helpers\Html::a('Новый пользователь', ['update'], ['class' => 'btn btn-success']) ?>
</div>

<?= GridView::widget([
	'filterModel' => $searchModel,
	'dataProvider' => $dataProvider,
	'columns' => [
		[
			'attribute' => 'id',
			'headerOptions' => ['width' => 100],
		],
		'username',
		'email',
		[
			'attribute' => 'status',
			'value' => function(User $model) {
				$statuses = User::getStatuses();
				return $statuses[$model->status];
			},
			'filter' => User::getStatuses(),
		],
		'is_admin:boolean',

		[
			'class' => \andrewdanilov\gridtools\FontawesomeActionColumn::class,
			'template' => '{update}{delete}',
		]
	]
]) ?>
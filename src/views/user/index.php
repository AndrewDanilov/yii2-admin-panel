<?php

/* @var $this \yii\web\View */
/* @var $searchModel UserSearch */
/* @var $dataProvider \yii\data\ActiveDataProvider */

use andrewdanilov\adminpanel\models\User;
use andrewdanilov\adminpanel\models\UserSearch;
use andrewdanilov\gridtools\FontawesomeActionColumn;
use yii\grid\GridView;
use yii\bootstrap5\Html;

$this->title = 'Пользователи';

?>

    <div class="form-group">
        <?= Html::a('Новый пользователь', ['update'], ['class' => 'btn btn-success']) ?>
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
            'class' => FontawesomeActionColumn::class,
            'template' => '{update}{delete}',
        ]
    ]
]) ?>
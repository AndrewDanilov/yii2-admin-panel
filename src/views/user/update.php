<?php

/* @var $this \yii\web\View */
/* @var $model User */

use andrewdanilov\adminpanel\models\User;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

if ($model->isNewRecord) {
	$this->title = 'Новый пользователь';
} else {
	$this->title = 'Редактирование пользователя ' . $model->username;
}
?>

<?php $form = ActiveForm::begin() ?>

<?= $form->field($model, 'username')->textInput() ?>

<?= $form->field($model, 'email')->textInput(['type' => 'email']) ?>

<?= $form->field($model, 'password')->textInput(['type' => 'password']) ?>

<?= $form->field($model, 'status')->dropDownList(User::getStatuses()) ?>

<?= $form->field($model, 'is_admin')->dropDownList(['Нет', 'Да']) ?>

<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>

<?php ActiveForm::end() ?>

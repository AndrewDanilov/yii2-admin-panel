<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \andrewdanilov\adminpanel\LoginForm */

$this->title = 'Sign In';

$fieldOptions = [
	'options' => ['class' => 'form-group'],
	'inputTemplate' => '{input}',
];

?>


<div class="login-box">

	<div class="text-center">
		<h1 class="h4">Admin Area</h1>
	</div>

	<?php $form = ActiveForm::begin([
		'options' => ['class' => 'user'],
		'enableClientValidation' => false,
		'fieldConfig' => [
			'template' => "{input}\n{error}",
			'errorOptions' => [
				'class' => 'text-danger small text-center',
				'style' => 'margin-top: 6px;',
			],
		],
	]) ?>

	<?= $form->field($model, 'email', $fieldOptions)
		->label(false)
		->textInput([
			'type' => 'email',
			'id' => 'exampleInputEmail',
			'class' => 'form-control form-control-user',
			'placeholder' => 'Email',
		])
	?>

	<?= $form->field($model, 'password', $fieldOptions)
		->label(false)
		->textInput([
			'type' => 'password',
			'id' => 'exampleInputPassword',
			'class' => 'form-control form-control-user',
			'placeholder' => 'Password',
		])
	?>

	<hr>

	<?= Html::submitButton('Войти', ['class' => 'btn btn-primary btn-user btn-block', 'name' => 'login-button']) ?>

	<?php ActiveForm::end() ?>

</div>

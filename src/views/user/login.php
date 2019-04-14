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

<div class="container">

	<!-- Outer Row -->
	<div class="row justify-content-center">

		<div class="col-xs-8 col-sm-6 col-md-4">

			<div class="card o-hidden border-0 shadow-lg my-5">
				<div class="card-body p-0">
					<!-- Nested Row within Card Body -->
					<div class="row">
						<div class="col-lg-12">
							<div class="p-5">
								<div class="text-center">
									<h1 class="h4 text-gray-900 mb-4">Admin Area</h1>
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
						</div>
					</div>
				</div>
			</div>

		</div>

	</div>

</div>

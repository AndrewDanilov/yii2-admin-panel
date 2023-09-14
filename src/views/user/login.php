<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap5\ActiveForm */
/* @var $model \andrewdanilov\adminpanel\models\LoginForm */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

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

    <?= $form->field($model, 'username', $fieldOptions)
        ->label(false)
        ->textInput([
            'class' => 'form-control form-control-user',
            'placeholder' => 'Username or E-mail',
        ])
    ?>

    <?= $form->field($model, 'password', $fieldOptions)
        ->label(false)
        ->textInput([
            'type' => 'password',
            'class' => 'form-control form-control-user',
            'placeholder' => 'Password',
        ])
    ?>

    <?= $form->field($model, 'rememberMe', $fieldOptions)
        ->checkbox()->label('Remember Me')
    ?>

    <hr>

    <?= Html::submitButton('Enter', ['class' => 'btn btn-primary btn-user btn-block', 'name' => 'login-button']) ?>

    <?php ActiveForm::end() ?>

</div>

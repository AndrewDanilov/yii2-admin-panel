<?php
namespace andrewdanilov\adminpanel;

use yii\base\Model;

class LoginForm extends Model
{
	public $email;
	public $password;

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['email', 'password'], 'required'],
			[['email'], 'email'],
		];
	}
}
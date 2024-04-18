<?php
namespace andrewdanilov\adminpanel\models;

use Yii;
use yii\base\Model;
use yii\web\IdentityInterface;

/**
 * Login form
 */
class LoginForm extends Model
{
	public $username;
	public $password;
	public $rememberMe = true;

	private $_user;


	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			// username and password are both required
			[['username', 'password'], 'required'],
			// rememberMe must be a boolean value
			['rememberMe', 'boolean'],
			// password is validated by validatePassword()
			['password', 'validatePassword'],
		];
	}

	/**
	 * Validates the password.
	 * This method serves as the inline validation for password.
	 *
	 * @param string $attribute the attribute currently being validated
	 * @param array $params the additional name-value pairs given in the rule
	 */
	public function validatePassword($attribute, $params)
	{
		if (!$this->hasErrors()) {
			$user = $this->getUser();
			if (!$user || !$user->validatePassword($this->password)) {
				$this->addError($attribute, 'Incorrect username or password.');
			}
		}
	}

	/**
	 * Logs in a user using the provided username and password.
	 *
	 * @return bool whether the user is logged in successfully
	 */
	public function login()
	{
		if ($this->validate()) {
			return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
		}

		return false;
	}

	/**
	 * Finds user by [[username]]
	 */
	protected function getUser()
	{
		if ($this->_user === null) {
			$identityClass = Yii::$app->user->identityClass;
			/* @var $identityClass IdentityInterface */
            $user = $identityClass::findByUsernameOrEmail($this->username);
            if ($user !== null) {
                if ($user->status === User::STATUS_ACTIVE) {
                    // everything is ok, returning found User
                    $this->_user = $user;
                } elseif ($user->status === User::STATUS_INACTIVE) {
                    // user has not yet been activated
                    $this->addError('username', 'User account has not yet been activated.');
                } else {
                    // another status error
                    $this->addError('username', 'User account has been deleted or blocked.');
                }
            }
		}

		return $this->_user;
	}
}

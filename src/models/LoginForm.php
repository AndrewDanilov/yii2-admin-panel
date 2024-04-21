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
            // status of registered user is validated by validateStatus()
            ['username', 'validateStatus'],
		];
	}

	/**
	 * Validates the password.
	 *
	 * @param string $attribute the attribute currently being validated
	 */
	public function validatePassword($attribute)
	{
		if (!$this->hasErrors()) {
			$user = $this->getUser();
			if (!$user || !$user->validatePassword($this->password)) {
				$this->addError($attribute, 'Incorrect username or password.');
			}
		}
	}

    /**
     * Validates status of user.
     *
     * @param string $attribute the attribute currently being validated
     */
    public function validateStatus($attribute)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if ($user !== null && $user->status !== User::STATUS_ACTIVE) {
                if ($user->status === User::STATUS_INACTIVE) {
                    // user has not yet been activated
                    $this->addError($attribute, 'User account has not yet been activated.');
                } else {
                    // another status error
                    $this->addError($attribute, 'Аккаунт пользователя был удален или заблокирован.');
                }
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
            $this->_user = $identityClass::findByUsernameOrEmail($this->username);
		}

		return $this->_user;
	}
}

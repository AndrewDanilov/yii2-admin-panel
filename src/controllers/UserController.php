<?php
namespace andrewdanilov\adminpanel\controllers;

use Yii;
use yii\web\Response;
use andrewdanilov\adminpanel\LoginForm;

class UserController extends BackendController
{
	/**
	 * Login action.
	 *
	 * @return Response|string
	 */
	public function actionLogin()
	{
		if (!Yii::$app->user->isGuest) {
			return $this->goHome();
		}
		$loginForm = new LoginForm();
		if ($loginForm->load(Yii::$app->request->post()) && $loginForm->validate() && Yii::$app->user->identityClass::login($loginForm)) {
			return $this->goBack();
		}
		if (Yii::$app->getSession()->getFlash('error') == 'access-denied') {
			// if we here because of access denied
			$loginForm->addError('email', 'Access denied for this user.');
		}
		$this->layout = '//login';
		return $this->render('login', [
			'model' => $loginForm,
		]);
	}

	/**
	 * Logout action.
	 *
	 * @return Response
	 */
	public function actionLogout()
	{
		Yii::$app->user->logout();
		return $this->goHome();
	}
}

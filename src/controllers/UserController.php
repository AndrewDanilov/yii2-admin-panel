<?php
namespace andrewdanilov\adminpanel\controllers;

use Yii;
use yii\web\Response;
use andrewdanilov\adminpanel\models\User;
use andrewdanilov\adminpanel\models\UserSearch;
use andrewdanilov\adminpanel\models\LoginForm;

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
		if ($loginForm->load(Yii::$app->request->post()) && $loginForm->validate() && $loginForm->login()) {
			return $this->goBack();
		}
		if (Yii::$app->getSession()->getFlash('error') == 'access-denied') {
			// if we here because of access denied
			$loginForm->addError('username', 'Access denied for this user.');
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

	public function actionIndex()
	{
		$searchModel = new UserSearch;
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	public function actionUpdate($id=null)
	{
		if ($id === null) {
			$model = new User();
		} else {
			$model = User::findOne(['id' => $id]);
		}
		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['index']);
		}
		return $this->render('update', ['model' => $model]);
	}

	public function actionDelete($id)
	{
		User::findOne(['id' => $id])->delete();
		return $this->redirect(['index']);
	}
}

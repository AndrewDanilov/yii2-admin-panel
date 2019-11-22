<?php
namespace andrewdanilov\adminpanel\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class BackendController extends Controller
{
	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::class,
				'rules' => [
					[
						'actions' => ['login'],
						'allow' => true,
					],
					[
						'allow' => true,
						'roles' => ['admin'],
					],
				],
				'denyCallback' => function () {
					if(!Yii::$app->user->isGuest) {
						Yii::$app->user->logout();
						// remember access denying happens, to show message about it in login form after
						Yii::$app->getSession()->setFlash('error', 'access-denied');
					}
					Yii::$app->user->loginRequired();
				},
			],
			'verbs' => [
				'class' => VerbFilter::class,
				'actions' => [
					'delete' => ['POST'],
				],
			],
		];
	}

	/**
	 * {@inheritDoc}
	 */
	public function actions()
	{
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
				'layout' => 'error',
			],
		];
	}
}
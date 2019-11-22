<?php
namespace andrewdanilov\adminpanel\components;

use Yii;
use yii\rbac\CheckAccessInterface;

class AccessChecker implements CheckAccessInterface
{
	/**
	 * @param int|string $userId
	 * @param string $permissionName
	 * @param array $params
	 * @return bool|void
	 */
	public function checkAccess($userId, $permissionName, $params = [])
	{
		if ($permissionName === 'admin') {
			return true; // remove this and
			             // add some data checking here instead of just returning true
			//return Yii::$app->user->identityClass::find()->where([
			//	'id' => $userId,
			//	'name' => 'username', // check if user name is 'admin' for example
			//	'status' => Yii::$app->user->identityClass::STATUS_ACTIVE,
			//])->exists();
		}
		return false;
	}
}
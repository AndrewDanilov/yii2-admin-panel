<?php
namespace andrewdanilov\adminpanel;

use Yii;
use yii\db\ActiveRecord;
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
			// Below is simple method of checking 'admin' permission.
			// Replace it if you want something more complex.
			$userClass = Yii::$app->user->identityClass;
			return $userClass::find()->where([
				'id' => $userId,
				'username' => 'admin', // check if user name is 'admin' for example
				'status' => $userClass::STATUS_ACTIVE,
			])->exists();
		}
		return false;
	}
}
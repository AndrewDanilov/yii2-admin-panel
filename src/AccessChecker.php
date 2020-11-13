<?php
namespace andrewdanilov\adminpanel;

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
			// Below is simple method of checking 'admin' permission.
			// Replace it if you want something more complex.
			/* @var \andrewdanilov\adminpanel\models\User $userClass */
			$userClass = Yii::$app->user->identityClass;
			return $userClass::find()->where([
				'id' => $userId,
				'is_admin' => 1,
				'status' => $userClass::STATUS_ACTIVE,
			])->exists();
		}
		return false;
	}
}
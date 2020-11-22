<?php
namespace andrewdanilov\adminpanel\models;

use yii\data\ActiveDataProvider;

class UserSearch extends User
{
	public function rules()
	{
		return [
			[['id', 'username', 'email', 'status', 'is_admin'], 'safe'],
		];
	}

	/**
	 * @param $params
	 * @return ActiveDataProvider
	 */
	public function search($params)
	{
		$query = User::find();

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		$this->load($params);

		if (!$this->validate()) {
			return $dataProvider;
		}

		$query->andFilterWhere([
			'id' => $this->id,
			'status' => $this->status,
			'is_admin' => $this->is_admin,
		]);

		$query->andFilterWhere(['like', 'username', $this->username])
			->andFilterWhere(['like', 'email', $this->email]);

		return $dataProvider;
	}
}
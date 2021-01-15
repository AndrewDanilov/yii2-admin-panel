<?php

use yii\db\Migration;

/**
 * Class m201026_111558_user_table_add_is_admin_field
 */
class m201026_111558_user_table_add_is_admin_field extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->addColumn('{{%user}}', 'is_admin', $this->tinyInteger(1)->unsigned()->notNull()->defaultValue(0));

	    $this->insert('{{%user}}', [
		    'username' => 'admin',
		    'email' => 'admin@example.com',
		    'auth_key' => Yii::$app->security->generateRandomString(),
		    'password_hash' => Yii::$app->security->generatePasswordHash('admin'),
		    'status' => 10,
		    'created_at' => date('Y-m-d H:i:s'),
		    'is_admin' => 1,
	    ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%user}}', ['is_admin' => 1]);
        $this->dropColumn('{{%user}}', 'is_admin');
    }
}

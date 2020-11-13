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
		$this->addColumn('user', 'is_admin', $this->tinyInteger(1)->unsigned()->notNull()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'is_admin');
    }
}

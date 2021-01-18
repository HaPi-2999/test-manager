<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m210112_093613_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string(),
            'last_name' => $this->string(),
            'patronymic' => $this->string(),
            'access_token' => $this->string(),
            'auth_key' => $this->string(),
            'email' => $this->string(),
            'gender' => $this->string(),
            'password' => $this->string(),
            'active' => $this->boolean(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}

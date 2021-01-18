<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tasks_users}}`.
 */
class m210112_093354_create_tasks_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tasks_users}}', [
            'id' => $this->primaryKey(),
            'status' => $this->string(),
            'scheduled_execution_time' => $this->integer(),
            'actual_execution_time' => $this->integer(),
            'task_id' => $this->integer(),
            'user_id' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tasks_users}}');
    }
}

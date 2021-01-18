<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%change_status_task_history}}`.
 */
class m210112_092654_create_change_status_task_history_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%change_status_task_history}}', [
            'id' => $this->primaryKey(),
            'status' => $this->string(),
            'task_id' => $this->integer(),
            'user_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%change_status_task_history}}');
    }
}

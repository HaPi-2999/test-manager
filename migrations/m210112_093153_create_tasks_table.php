<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tasks}}`.
 */
class m210112_093153_create_tasks_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%tasks}}', [
            'id' => $this->primaryKey(),
            'description' => $this->string(),
            'status' => $this->string(),
            'type' => $this->string(),
            'priority' => $this->string(),
            'project_id' => $this->integer(),
            'is_file_control' => $this->boolean(),
            'is_production_update' => $this->boolean(),
            'is_error' => $this->boolean(),
            'updated_at' => $this->boolean(),
            'created_at' => $this->boolean(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%tasks}}');
    }
}

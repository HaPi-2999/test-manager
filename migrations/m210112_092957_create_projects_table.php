<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%projects}}`.
 */
class m210112_092957_create_projects_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%projects}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'contact_person' => $this->string(),
            'email' => $this->string(),
            'description' => $this->string(),
            'phone' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%projects}}');
    }
}

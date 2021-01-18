<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comments}}`.
 */
class m210112_092758_create_comments_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%comments}}', [
            'id' => $this->primaryKey(),
            'namespace' => $this->string(),
            'text' => $this->string(),
            'field_id' => $this->integer(),
            'parent_id' => $this->integer(),
            'user_id' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%comments}}');
    }
}

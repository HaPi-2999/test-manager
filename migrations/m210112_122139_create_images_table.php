<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%images}}`.
 */
class m210112_122139_create_images_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%images}}', [
            'id' => $this->primaryKey(),
            'field_id' => $this->integer(),
            'namespace' => $this->string(),
            'path' => $this->string(),
            'type' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%images}}');
    }
}

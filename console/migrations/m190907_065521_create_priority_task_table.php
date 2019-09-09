<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%priority_task}}`.
 */
class m190907_065521_create_priority_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%priority_task}}', [
            'id' => $this->primaryKey(),
            'priority_name' => $this->string(255)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%priority_task}}');
    }
}

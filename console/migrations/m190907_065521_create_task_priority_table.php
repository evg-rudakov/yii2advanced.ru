<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%priority_task}}`.
 */
class m190907_065521_create_task_priority_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%task_priority}}', [
            'id' => $this->primaryKey(),
            'priority_name' => $this->string(255)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%task_priority}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%status_task}}`.
 */
class m190907_063234_create_task_status_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%task_status}}', [
            'id' => $this->primaryKey(),
            'status_name' => $this->string(255)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%task_status}}');
    }
}

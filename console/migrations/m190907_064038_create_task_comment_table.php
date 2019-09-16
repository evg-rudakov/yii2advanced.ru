<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%task_comment}}`.
 */
class m190907_064038_create_task_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%task_comment}}', [
            'id' => $this->primaryKey(),
            'author_id' => $this->integer()->notNull(),
            'task_id' => $this->integer()->notNull(),
            'comment_text' => $this->string()->notNull(),
        ]);
        $this->addForeignKey(
            'fk_task_comment_task_id',
            'task_comment',
            'task_id',
            'task',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_task_comment_user_id',
            'task_comment',
            'author_id',
            'user',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_task_comment_task_id', 'task_comment');
        $this->dropForeignKey('fk_task_comment_user_id', 'task_comment');
        $this->dropTable('{{%task_comment}}');
    }
}

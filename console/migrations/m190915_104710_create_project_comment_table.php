<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%project_comment}}`.
 */
class m190915_104710_create_project_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%project_comment}}', [
            'id' => $this->primaryKey(),
            'author_id' => $this->integer()->notNull(),
            'project_id' => $this->integer()->notNull(),
            'comment_text' => $this->string()->notNull(),
        ]);
        $this->addForeignKey(
            'fk_project_comment_project_id',
            'project_comment',
            'project_id',
            'project',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_project_comment_user_id',
            'project_comment',
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
        $this->dropForeignKey('fk_project_comment_project_id', 'project_comment');
        $this->dropForeignKey('fk_project_comment_user_id', 'project_comment');
        $this->dropTable('{{%project_comment}}');
    }
}

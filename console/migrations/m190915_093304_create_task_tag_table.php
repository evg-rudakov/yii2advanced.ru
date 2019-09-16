<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%task_tag}}`.
 */
class m190915_093304_create_task_tag_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%task_tag}}', [
            'task_id' => $this->integer()->notNull(),
            'tag_id' => $this->integer()->notNull(),
            'PRIMARY KEY (task_id,tag_id)',
        ]);
        $this->addForeignKey(
            'fk_task_tag_task_id',
            'task_tag',
            'task_id',
            'task',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_task_tag_tag_id',
            'task_tag',
            'tag_id',
            'tag',
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
        $this->dropForeignKey('fk_task_tag_task_id', 'task_tag');
        $this->dropForeignKey('fk_task_tag_tag_id', 'task_tag');
        $this->dropTable('{{%task_tag}}');
    }
}

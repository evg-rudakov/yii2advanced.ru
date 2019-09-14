<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tag}}`.
 */
class m190907_063751_create_tag_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tag}}', [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer()->notNull(),
            'tag_name' => $this->string(255)->notNull(),
        ]);
        $this->addForeignKey(
            'fk_tag_task_id',
            'tag',
            'task_id',
            'task',
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
        $this->dropForeignKey('fk_tag_task_id', 'tag');
        $this->dropTable('{{%tag}}');
    }
}

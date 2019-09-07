<?php

use yii\db\Migration;

/**
 * Class m190907_065703_add_fk_priority_id_to_task_table
 */
class m190907_065703_add_fk_priority_id_to_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk_task_priority_id',
            'task',
            'priority_id',
            'priority_task',
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
        $this->dropForeignKey('fk_task_priority_id');
    }
}

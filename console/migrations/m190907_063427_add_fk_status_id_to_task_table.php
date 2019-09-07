<?php

use yii\db\Migration;

/**
 * Class m190907_063427_add_fk_status_id_to_task_table
 */
class m190907_063427_add_fk_status_id_to_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk_task_status_id',
            'task',
            'status_id',
            'status_task',
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
        $this->dropForeignKey('fk_task_status_id');
    }
}

<?php

use yii\db\Migration;

/**
 * Class m190915_102948_add_fk_project_id_to_task_table
 */
class m190915_102948_add_fk_project_id_to_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk_task_project_id',
            'task',
            'project_id',
            'project',
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
        $this->dropForeignKey('fk_task_project_id', 'task');
    }
}

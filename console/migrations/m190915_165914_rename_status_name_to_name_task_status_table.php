<?php

use yii\db\Migration;

/**
 * Class m190915_165914_rename_status_name_to_name_task_status_table
 */
class m190915_165914_rename_status_name_to_name_task_status_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('task_status', 'status_name', 'name');
        $this->renameColumn('task_priority', 'priority_name', 'name');
        $this->renameColumn('project_status', 'status_name', 'name');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn('task_status', 'name', 'status_name');
        $this->renameColumn('task_priority', 'name', 'priority_name');
        $this->renameColumn('project_status', 'name', 'status_name');
    }
}

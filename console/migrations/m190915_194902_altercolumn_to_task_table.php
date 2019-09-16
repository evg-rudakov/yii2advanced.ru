<?php

use yii\db\Migration;

/**
 * Class m190915_194902_altercolumn_to_task_table
 */
class m190915_194902_altercolumn_to_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('task', 'created_at', $this->integer());
        $this->alterColumn('task', 'updated_at', $this->integer());
        $this->alterColumn('task', 'project_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('task', 'created_at', $this->integer()->notNull());
        $this->alterColumn('task', 'updated_at', $this->integer()->notNull());
        $this->alterColumn('task', 'project_id', $this->integer()->notNull());
    }
}

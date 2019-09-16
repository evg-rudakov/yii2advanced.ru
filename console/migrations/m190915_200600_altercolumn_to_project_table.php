<?php

use yii\db\Migration;

/**
 * Class m190915_200600_altercolumn_to_project_table
 */
class m190915_200600_altercolumn_to_project_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('project', 'created_at', $this->integer());
        $this->alterColumn('project', 'updated_at', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('project', 'created_at', $this->integer()->notNull());
        $this->alterColumn('project', 'updated_at', $this->integer()->notNull());
    }
}

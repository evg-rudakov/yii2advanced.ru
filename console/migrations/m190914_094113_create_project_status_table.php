<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%project_status}}`.
 */
class m190914_094113_create_project_status_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%project_status}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%project_status}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Class m190918_145241_add_field_project_id_to_chat_log_table
 */
class m190918_145241_add_field_project_id_to_chat_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('chat_log', 'project_id', $this->integer()->notNull());
        $this->addForeignKey(
            'fk_chat_log_project_id',
            'chat_log',
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
        $this->dropForeignKey('fk_chat_log_project_id', 'chat_log');
        $this->dropColumn('chat_log', 'project_id');
    }
}

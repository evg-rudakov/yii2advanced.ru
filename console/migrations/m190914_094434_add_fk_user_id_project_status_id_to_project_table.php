<?php

use yii\db\Migration;

/**
 * Class m190914_094434_add_fk_user_id_project_status_id_to_project_table
 */
class m190914_094434_add_fk_user_id_project_status_id_to_project_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk_project_user_id',
            'project',
            'user_id',
            'user',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_project_project_status_id',
            'project',
            'project_status_id',
            'project_status',
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
        $this->dropForeignKey('fk_project_user_id', 'project');
        $this->dropForeignKey('fk_project_project_status_id', 'project');
    }
}

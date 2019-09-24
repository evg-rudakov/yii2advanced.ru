<?php

namespace api\modules\v1\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "project_status".
 *
 * @property int $id
 * @property string $name
 *
 * @property Project[] $projects
 */
class ProjectStatus extends ActiveRecord
{
    const IN_PROGRESS_ID = 1;
    const IN_PLANNING_ID = 2;
    const FINISHED = 3;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Status Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjects()
    {
        return $this->hasMany(Project::class, ['status_id' => 'id']);
    }

    public static function getValueName() {
        return [
            self::IN_PROGRESS_ID => 'В работе',
            self::IN_PLANNING_ID => 'Планируется',
            self::FINISHED => 'Завершен',

        ];
    }
}

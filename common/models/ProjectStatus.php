<?php

namespace common\models;

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
    const NEW_ID = 1;
    const IN_PROGRESS_ID = 2;
    const ON_TESTING_ID = 3;
    const READY_ID = 4;
    const ARCHIVE_ID = 5;

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
            self::NEW_ID => 'Новый',
            self::IN_PROGRESS_ID => 'В работе',
            self::ON_TESTING_ID => 'На тестировании',
            self::READY_ID => 'Выполнен',
            self::ARCHIVE_ID => 'Архивный',
        ];
    }
}

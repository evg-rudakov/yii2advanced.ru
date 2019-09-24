<?php

namespace api\modules\v1\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "task_priority".
 *
 * @property int $id
 * @property string $name
 *
 * @property Task[] $tasks
 */
class TaskPriority extends ActiveRecord
{
    const LOW_ID = 1;
    const NORMAL_ID = 2;
    const HIGH_ID = 3;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task_priority';
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
            'name' => 'Priority Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::class, ['priority_id' => 'id']);
    }

    public static function getValueName() {
        return [
            self::LOW_ID => 'Низкий',
            self::NORMAL_ID => 'Нормальный',
            self::HIGH_ID => 'Высокий',
        ];
    }
}

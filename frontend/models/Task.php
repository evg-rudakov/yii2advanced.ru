<?php

namespace frontend\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $author_id
 * @property int $status_id
 * @property int $priority_id
 *
 * @property Comment[] $comments
 * @property Tag[] $tags
 * @property PriorityTask $priority
 * @property StatusTask $status
 */
class Task extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'author_id', 'status_id', 'priority_id'], 'required'],
            [['description'], 'string'],
            [['author_id', 'status_id', 'priority_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['priority_id'], 'exist', 'skipOnError' => true, 'targetClass' => PriorityTask::class, 'targetAttribute' => ['priority_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => StatusTask::class, 'targetAttribute' => ['status_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID task',
            'name' => 'Name Task',
            'description' => 'Description',
            'author_id' => 'Author ID',
            'status_id' => 'Status ID',
            'priority_id' => 'Priority ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::class, ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::class, ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPriority()
    {
        return $this->hasOne(PriorityTask::class, ['id' => 'priority_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(StatusTask::class, ['id' => 'status_id']);
    }
}

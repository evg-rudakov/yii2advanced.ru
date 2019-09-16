<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use common\models\User;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $author_id
 * @property int $status_id
 * @property int $priority_id
 * @property int $project_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property TaskPriority $priority
 * @property Project $project
 * @property TaskStatus $status
 * @property User $author
 * @property TaskComment[] $taskComments
 * @property TaskTag[] $taskTags
 * @property Tag[] $tags
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
            [['project_id', 'created_at', 'updated_at'], 'safe'],
            [['description'], 'string'],
            [['author_id', 'status_id', 'priority_id', 'project_id', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['priority_id'], 'exist', 'skipOnError' => true, 'targetClass' => TaskPriority::class, 'targetAttribute' => ['priority_id' => 'id']],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::class, 'targetAttribute' => ['project_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => TaskStatus::class, 'targetAttribute' => ['status_id' => 'id']],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    public function behaviors()
    {
        return [
            'timestampBehavior' => [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                    'value' => time(),
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'author_id' => 'Author ID',
            'status_id' => 'Status ID',
            'priority_id' => 'Priority ID',
            'project_id' => 'Project ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPriority()
    {
        return $this->hasOne(TaskPriority::class, ['id' => 'priority_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::class, ['id' => 'project_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(TaskStatus::class, ['id' => 'status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::class, ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaskComments()
    {
        return $this->hasMany(TaskComment::class, ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaskTags()
    {
        return $this->hasMany(TaskTag::class, ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::class, ['id' => 'tag_id'])
            ->viaTable('task_tag', ['task_id' => 'id']);
    }

    public function fields()
    {
        $parentFields = parent::fields();
        $modelFields = [
            'created_at' => function() {
                if (isset($this->created_at)) {
                    return Yii::$app->formatter->asDatetime($this->created_at);
                }

                return null;
            },
            'updated_at' => function() {
                if (isset($this->updated_at)) {
                    return Yii::$app->formatter->asDatetime($this->updated_at);
                }

                return null;
            },
            'priority_id' => function() {
                return $this->priority->name;
            },
            'status_id' => function() {
                return $this->status->name;
            },
            'author_id' => function() {
                return $this->author->username;
            }
        ];

        return array_merge($parentFields, $modelFields);
    }
}

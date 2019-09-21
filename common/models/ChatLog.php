<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "chat_log".
 *
 * @property int $id
 * @property string $username
 * @property string $message
 * @property int $created_at
 * @property int $updated_at
 * @property int $project_id
 *
 * @property Project $project
 */
class ChatLog extends ActiveRecord
{
    const TIME_BEHAVIOR_NAME = 'timeBehavior';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chat_log';
    }

    public function behaviors()
    {
        return [
            self::TIME_BEHAVIOR_NAME => [
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
    public function rules()
    {
        return [
            [['username', 'created_at', 'updated_at', 'project_id'], 'required'],
            [['created_at', 'updated_at', 'project_id'], 'integer'],
            [['username', 'message'], 'string', 'max' => 255],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::class, 'targetAttribute' => ['project_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'message' => 'Message',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'project_id' => 'Project ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::class, ['id' => 'project_id']);
    }

    public static function saveLog(string $msg) {
        try {
            $msg =  json_decode($msg, true);
            var_dump($msg);
            $model = new self();
            $model->username = $msg['username'];
            $model->message = $msg['message'];
            $model->save();
        } catch (\Throwable $exception) {
            Yii::error($exception->getMessage());
        }
    }
}

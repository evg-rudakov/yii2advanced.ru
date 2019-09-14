<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "chat_log".
 *
 * @property int $id
 * @property string $username
 * @property string $message
 * @property int $created_at
 *
 * @property User $user
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
            [['username', 'created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['username', 'message'], 'string', 'max' => 255],
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
        ];
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

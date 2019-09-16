<?php

namespace frontend\controllers;

use Yii;
use common\models\Task;
use yii\rest\ActiveController;

class TaskController extends ActiveController
{
    public $modelClass = Task::class;

    public function actionRandom($count = 1) {
        $output = [];
        $errors = [];

        Yii::$app->db->beginTransaction();
        try {
            for ($i = 0; $i < $count; $i++) {
                $task = new Task();
                $task->name = Yii::$app->security->generateRandomString(5);
                $task->description = Yii::$app->security->generateRandomString(10);
                $task->author_id = 1;
                $task->status_id = 1;
                $task->priority_id = 2;
                if ($task->save()) {
                    $output[$i] = $task->attributes;
                } else {
                    $errors[$i] = $task->errors;
                }
            }

            $result = empty($errors);
            if ($result) {
                Yii::$app->db->transaction->commit();
            } else {
                Yii::$app->db->transaction->rollBack();
            }

            return ['result' => empty($errors), 'errors' => $errors, 'output' => $output];
        } catch (\Throwable $exception) {
            Yii::$app->db->transaction->rollBack();
            return ['result' => false, 'errors' => $exception->getMessage()];
        }

    }
}

<?php

namespace api\modules\v1\controllers;

use Yii;
use api\modules\v1\models\Task;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaskController implements the CRUD actions for Task model.
 */
class TaskController extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\Task';
}

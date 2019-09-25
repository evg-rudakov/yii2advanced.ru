<?php

namespace api\modules\v1\controllers;

use Yii;
use api\modules\v1\models\User;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;

class UserController extends ActiveController
{
    public $modelClass = User::class;

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
            'except' => ['create'],
        ];

        return $behaviors;
    }

    public function actionMe() {
        Yii::$app->user->identity;
    }
}

<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
use common\models\User;

class UserDefaultController extends Controller
{
    private function addusers(string $usr, string $mail, string $psw, string $authusr) {
        $model = User::find()->where(['username' => $usr])->one();
        if (empty($model)) {
            $user = new User();
            $user->username = $usr;
            $user->email = $mail;
            $user->setPassword($psw);
            $user->generateAuthKey();
            if ($user->save()) {
                echo "{$usr} created! \r\n";
                $role = Yii::$app->authManager->getRole($authusr);
                Yii::$app->authManager->assign($role, (string) $user->id);
                echo "{$usr} assignment '{$authusr}' \r\n";
            } else {
                var_dump($user->id);
                var_dump($user->errors);
                die();
            }
        }
    }

    public function actionAddAdmin() {
        $this->addusers('admin', 'ananinpgu@mail.ru', 'admin', 'admin');
    }

    public function actionAddUserTest() {
        $this->addusers('user-test', 'ananintest@mail.ru', 'user', 'simple');
    }
}
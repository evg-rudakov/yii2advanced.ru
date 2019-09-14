<?php

namespace console\controllers;

use common\models\AuthAssignment;
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
                $auth = new AuthAssignment();
                $auth->item_name = $authusr;
                $auth->user_id = (string) $user->id;
                if ($auth->save()) {
                    echo "{$usr} assignment '{$authusr}' \r\n";
                } else {
                    var_dump($auth->item_name);
                    var_dump($auth->errors);
                    die();
                }
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
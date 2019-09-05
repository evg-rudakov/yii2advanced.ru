<?php

namespace frontend\controllers;

use yii\web\Controller;

class HelloController extends Controller
{
    public function actionWorld()
    {
        return $this->render('world');
    }
}
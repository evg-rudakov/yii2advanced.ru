<?php

namespace console\controllers;

use common\models\ProjectStatus;
use common\models\TaskPriority;
use common\models\TaskStatus;
use yii\base\Model;
use yii\console\Controller;

class FillDbController extends Controller
{
    private function fill($getTable) {
        foreach ($getTable::getValueName() as $id => $name) {
            $search = $getTable::findOne($id);
            if (!isset($search)) {
                $search = new $getTable();
                $search->id = $id;
            }
            $search->name = $name;
            if ($search->save()) {
                echo "{$getTable}.id = {$id} with name = {$name} is created \r\n";
            } else {
                var_dump($search->id);
                var_dump($search->errors);
                die();
            }
        }
    }

    public function actionFillStatus() {
        $this->fill(TaskStatus::class);
        $this->fill(TaskPriority::class);
        $this->fill(ProjectStatus::class);
    }
}
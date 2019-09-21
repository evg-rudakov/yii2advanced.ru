<?php

use common\models\Task;
use common\models\TaskPriority;
use common\models\TaskStatus;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function(Task $model) {
                    return Html::a($model->name, ['task/view', 'id' => $model->id]);
                }
            ],
            'description:ntext',
            [
                'attribute' => 'statusName',
                'filter' => TaskStatus::getValueName(),
                'value' => function(Task $model) {
                    return $model->status->name;
                }
            ],
            [
                'attribute' => 'priorityName',
                'filter' => TaskPriority::getValueName(),
                'value' => function(Task $model) {
                    return $model->priority->name;
                }
            ],
            [
                'attribute' => 'taskCreated',
                'value' => function(Task $model) {
                    return Yii::$app->formatter->asDate($model->created_at, 'dd.MM.yyy');
                }
            ],
            [
                'attribute' => 'author',
                'value' => function(Task $model) {
                    return $model->author->username;
                }
            ],
        ],
    ]); ?>


</div>

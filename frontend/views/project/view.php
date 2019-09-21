<?php

use common\models\Task;
use common\models\TaskPriority;
use common\models\TaskStatus;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Project */
/* @var $taskSearchModel backend\models\search\TaskSearch */
/* @var $taskDataProvider yii\data\ActiveDataProvider */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="project-view">

    <h1>Tasks for <?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $taskDataProvider,
        'filterModel' => $taskSearchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

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
            //'created_at',
            //'updated_at',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

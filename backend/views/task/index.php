<?php

use common\models\Task;
use common\models\TaskPriority;
use common\models\TaskStatus;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $filterAuthor common\models\User[] */
/* @var $filterProject common\models\Project[] */

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Task', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
                'attribute' => 'authorName',
                'filter' => $filterAuthor,
                'value' => function(Task $model) {
                    return $model->author->username;
                }
            ],
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
                'attribute' => 'projectName',
                'filter' => $filterProject,
                'value' => function(Task $model) {
                    if (!empty($model->project)) {
                        return $model->project->name;
                    } else {
                        return null;
                    }
                }
            ],
            [
                'attribute' => 'taskCreated',
                'value' => function(Task $model) {
                    return Yii::$app->formatter->asDate($model->created_at, 'dd.MM.yyy');
                }
            ],
            //'created_at:datetime',
            //'updated_at:datetime',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

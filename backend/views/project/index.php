<?php

use common\models\Project;
use common\models\ProjectStatus;
use yii\helpers\Html;
use yii\grid\GridView;
use function foo\func;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $filterAuthor common\models\User[] */

$this->title = 'Projects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Project', ['create'], ['class' => 'btn btn-success']) ?>
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
                'value' => function(Project $model) {
                    return Html::a($model->name, ['project/view', 'id' => $model->id]);
                }
            ],
            'description',
            [
                'attribute' => 'authorName',
                'filter' => $filterAuthor,
                'value' => function(Project $model) {
                    return $model->author->username;
                }
            ],
            [
                'attribute' => 'statusName',
                'filter' => ProjectStatus::getValueName(),
                'value' => function(Project $model) {
                    return $model->status->name;
                }
            ],
            [
                'attribute' => 'taskCreated',
                'value' => function(Project $model) {
                    return Yii::$app->formatter->asDate($model->created_at, 'dd.MM.yyy');
                }
            ],
            //'created_at',
            //'updated_at',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

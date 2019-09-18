<?php

use common\models\Project;
use common\models\ProjectStatus;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'My projects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

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
                'attribute' => 'statusName',
                'filter' => ProjectStatus::getValueName(),
                'value' => function(Project $model) {
                    return $model->status->name;
                }
            ],
            [
                'attribute' => 'projectCreated',
                'value' => function(Project $model) {
                    return Yii::$app->formatter->asDate($model->created_at, 'dd.MM.yyy');
                }
            ],
            //'created_at',
            //'updated_at',
        ],
    ]); ?>


</div>

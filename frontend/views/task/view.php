<?php

use common\models\Task;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Task */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="task-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description:ntext',
            [
                'label' => 'Author Name',
                'value' => function(Task $model) {
                    return $model->author->username;
                }
            ],
            'status.name',
            'priority.name',
            [
                'label' => 'Project Name',
                'value' => function(Task $model) {
                    if (!empty($model->project)) {
                        return $model->project->name;
                    } else {
                        return null;
                    }
                }
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>

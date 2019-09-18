<?php

use common\models\User;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $filterAuthorEmail common\models\User[] */
/* @var $filterAuthorUsername common\models\User[] */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'userName',
                'format' => 'raw',
                'filter' => $filterAuthorUsername,
                'value' => function(User $model) {
                    return Html::a($model->username, ['user/view', 'id' => $model->id]);
                }
            ],
            //'auth_key',
            //'password_hash',
            //password_reset_token',
            [
                'attribute' => 'emailName',
                'filter' => $filterAuthorEmail,
                'value' => function(User $model) {
                    return $model->email;
                }
            ],
            [
                'attribute' => 'statusName',
                'filter' => User::getValueName(),
                'value' => function(User $model) {
                    return User::getValueName()[$model->status];
                }
            ],
            [
                'attribute' => 'UserCreated',
                'value' => function(User $model) {
                    return Yii::$app->formatter->asDate($model->created_at, 'dd.MM.yyy');
                }
            ],
            //'updated_at',
            //'verification_token',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

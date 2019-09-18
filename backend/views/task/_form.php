<?php

use common\models\Project;
use common\models\TaskPriority;
use common\models\TaskStatus;
use common\models\User;
use common\models\Task;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model Task */
/* @var $form ActiveForm */
/* @var $authors User[] */
/* @var $projects Project[] */
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'author_id')->dropDownList($authors)->label('Author Name') ?>

    <?= $form->field($model, 'status_id')->dropDownList(TaskStatus::getValueName())->label('Status Name') ?>

    <?= $form->field($model, 'priority_id')->dropDownList(TaskPriority::getValueName())->label('Priority Name') ?>

    <?= $form->field($model, 'project_id')->dropDownList($projects)->label('Project Name') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

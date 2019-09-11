<?php
/** @var string $username */

use yii\helpers\Html;
?>

<div id="chat" style="min-height: 100px;"></div>
<div id="response"></div>
<div class="row">
    <div class="col-lg-9">
        <?= Html::textInput('message', '', ['id' => 'message', 'class' => 'form-control']) ?>
    </div>
    <div class="col-lg-3">
        <?= Html::button('Отправить', ['id' => 'send', 'class' => 'btn btn-primary']) ?>
    </div>
</div>

<?= Html::hiddenInput('username', $username, ['class' => 'js-username']) ?>
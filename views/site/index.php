<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'Lottery Application';
?>
<div class="site-index">

    <?php if (Yii::$app->session->hasFlash('signUpFormSubmitted')): ?>
        <div class="alert alert-success">
            Thank you for register.
        </div>
    <?php endif; ?>

    <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">You have the opportunity to receive a gift )))</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get Gift ...</a></p>
    </div>
</div>

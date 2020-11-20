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

    <?php if(!Yii::$app->user->isGuest): ?>
    <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">You have the opportunity to receive a gift )))</p>
        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get Gift ...</a></p>
    </div>
    <?php else: ?>
        <div class="jumbotron">
            <h1>Welcome to Lottery</h1>

            <p class="lead">Pass the registration or <a href="<?php echo Url::to(['/site/login']); ?>">sign in</a> to get the gift!</p>
            <p><a class="btn btn-lg btn-success" href="<?php echo Url::to(['/sign-up/index']); ?>">Sign Up Now</a></p>
        </div>
    <?php endif; ?>
</div>

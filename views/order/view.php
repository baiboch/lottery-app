<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\Order;
use yii\helpers\Url;

$this->title = 'View Gift';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">You have a gift )))
            <span class="text-uppercase text-primary"><?php echo $order->getOrderName(); ?></span>
        </p>

        <p><a class="btn btn-lg btn-success" href="<?php echo Url::to(['order/execute']); ?>">Try again</a></p>
    </div>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'view-order-form']); ?>

            <?= $form->field($model, 'is_approved')->checkbox() ?>

            <?php if($order->type === Order::GIFT_MONEY_CODE): ?>
                <?= $form->field($model, 'convert_to_points')->checkbox() ?>
            <?php endif; ?>

            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'view-order-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

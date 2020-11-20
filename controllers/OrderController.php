<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use app\strategy\GiftOrderFactory;
use app\models\Order;
use app\models\form\ViewOrderForm;

class OrderController extends Controller {

    public function actionExecute() {

        $orderCreator = GiftOrderFactory::createRandomGift();
        $order = $orderCreator->createOrder();

        if ($order) {
            return $this->redirect(Url::to(['order/view', 'order_id' => $order->getId()]));
        }

        return $this->goHome();
    }

    public function actionView() {
        $model = new ViewOrderForm();

        $request = Yii::$app->request;

        $order = Order::findOne($request->get('order_id'));

        if ($model->load(Yii::$app->request->post())) {
            if ($model->submit($order)) {
                Yii::$app->session->setFlash('newOrderCreated');
            }
            $this->goHome();
        }

        return $this->render('view', [
            'model' => $model,
            'order' => $order
        ]);
    }
}

<?php

namespace app\factory;

use Yii;
use app\strategy\GiftOrderInterface;
use app\models\Transaction;
use app\models\Order;

class PointsGiftOrderCreator extends GiftOrderCreator implements GiftOrderInterface
{
    public function createOrder(): Order {
        $order = new Order();
        $order->status = 0;
        $order->type = Order::GIFT_POINTS_CODE;
        $order->is_approved = 0;
        $order->points = 100;
        $order->user_id = Yii::$app->user->getId();
        $order->save();

        return $order;
    }

    public function createTransaction(): Transaction {
        $transaction = new Transaction();
        $transaction->type = Order::GIFT_POINTS_CODE;
        $transaction->name = Order::GIFT_POINTS_LABEL;
        $transaction->order_id = $this->order->getId();
        $transaction->user_id = Yii::$app->user->getId();

        if ($transaction->save()) {
            $this->order->status = Order::ORDER_PROCESSED;
            return $transaction;
        }
        return null;
    }
}

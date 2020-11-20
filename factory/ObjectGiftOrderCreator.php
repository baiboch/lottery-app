<?php

namespace app\factory;

use Yii;
use app\strategy\GiftOrderInterface;
use app\models\Transaction;
use app\models\Order;

class ObjectGiftOrderCreator extends GiftOrderCreator implements GiftOrderInterface
{
    public function createOrder(): Order {
        $order = new Order();
        $order->status = 0;
        $order->type = Order::GIFT_OBJECT_CODE;
        $order->is_approved = 0;
        $order->gift = 'gift name';
        $order->user_id = Yii::$app->user->getId();

        return $order;
    }

    public function createTransaction(): Transaction {
        $transaction = new Transaction();
        $transaction->type = Order::GIFT_OBJECT_CODE;
        $transaction->name = Order::GIFT_OBJECT_LABEL;
        $transaction->order_id = $this->order->getId();
        $transaction->user_id = Yii::$app->user->getId();

        if ($transaction->save()) {
            $this->order->status = Order::ORDER_PROCESSED;
            return $transaction;
        }
        return null;
    }
}

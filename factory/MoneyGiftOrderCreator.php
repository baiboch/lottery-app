<?php

namespace app\factory;

use Yii;
use app\strategy\GiftOrderInterface;
use app\models\Transaction;
use app\models\Order;

class MoneyGiftOrderCreator extends GiftOrderCreator implements GiftOrderInterface
{
    const POINTS_TO_MONEY_CONVERT_VALUE = 1.5;

    public function createOrder(): Order {
        $order = new Order();
        $order->status = 0;
        $order->type = Order::GIFT_MONEY_CODE;
        $order->is_approved = 0;
        $order->money = rand(100, 1000);
        $order->user_id = Yii::$app->user->getId();

        return $order;
    }

    public function convertToPoints(): Order {
        $money = $this->order->money;
        $this->order->money = 0;
        $this->order->points = $money * self::POINTS_TO_MONEY_CONVERT_VALUE;
        $this->order->convert_to_points = Order::CONVERT_TO_POINTS;

        return $this->order;
    }

    public function createTransaction(): Transaction {
        $transaction = new Transaction();
        $transaction->type = Order::GIFT_MONEY_CODE;
        $transaction->name = Order::GIFT_MONEY_LABEL;
        $transaction->order_id = $this->order->getId();
        $transaction->user_id = Yii::$app->user->getId();

        if ($transaction->save()) {
            $this->order->status = Order::ORDER_PROCESSED;
            return $transaction;
        }
        return null;
    }
}

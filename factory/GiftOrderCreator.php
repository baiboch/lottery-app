<?php

namespace app\factory;

use app\models\Order;

abstract class GiftOrderCreator
{
    /**
     * @var Order $order
     */
    protected $order;

    public function setOrder(Order $order) {
        $this->order = $order;
    }

    public function getOrder(): Order {
        return $this->order;
    }

    public function setApproved(): Order {
        $this->order->is_approved = Order::ORDER_APPROVED;

        return $this->order;
    }
}

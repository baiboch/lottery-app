<?php

namespace app\strategy;

use app\models\Order;
use app\models\Transaction;

interface GiftOrderInterface
{
    public function getOrder(): Order;

    public function setOrder(Order $order);

    public function createOrder(): Order;

    public function setApproved(): Order;

    public function createTransaction(): Transaction;
}

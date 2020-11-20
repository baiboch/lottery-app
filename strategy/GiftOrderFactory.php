<?php

namespace app\strategy;

use app\models\Order;
use app\factory\GiftOrderCreator;
use app\factory\MoneyGiftOrderCreator;
use app\factory\PointsGiftOrderCreator;
use app\factory\ObjectGiftOrderCreator;

class GiftOrderFactory
{
    public static function getGiftOrder($type) {
        switch ($type) {
            case Order::GIFT_MONEY_CODE:
                return new MoneyGiftOrderCreator();

            case Order::GIFT_POINTS_CODE:
                return new PointsGiftOrderCreator();

            case Order::GIFT_OBJECT_CODE:
                return new ObjectGiftOrderCreator();
            default:
                return null;
        }
    }
    public static function createRandomGift(): GiftOrderCreator {

        $randGiftType = rand(1, 3);

        return self::getGiftOrder($randGiftType);
    }
}

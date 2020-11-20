<?php

namespace tests\unit\models;

use app\factory\MoneyGiftOrderCreator;
use app\models\Order;

class UserTest extends \Codeception\Test\Unit
{
    /**
     * @var Order $orderMock
     */
    private $orderMock;

    public function testConvertMoneyToPoints()
    {
        /** @var Order $model */
        $this->orderMock = $this->getMockBuilder(Order::class)
            ->setMethods(['save', 'attributes'])
            ->getMock();

        $this->orderMock->method('save')->willReturn(true);
        $this->orderMock->method('attributes')->willReturn([
            'money',
            'points',
            'convert_to_points'
        ]);

        $this->orderMock->money = 100;

        $orderCreator = new MoneyGiftOrderCreator();
        $orderCreator->setOrder($this->orderMock);
        $this->orderMock = $orderCreator->convertToPoints();

        echo $this->orderMock->points . "adasdas\n";
        echo $this->orderMock->money;

        expect($this->orderMock->points)->equals(150);
        expect($this->orderMock->convert_to_points)->equals(1);
    }
}

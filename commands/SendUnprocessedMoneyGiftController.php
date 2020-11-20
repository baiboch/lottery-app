<?php

namespace app\commands;

use app\models\Order;
use app\models\Transaction;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\db\Query;
use yii\helpers\Console;

class SendUnprocessedMoneyGiftController extends Controller
{
    public function actionProceed($count = 10)
    {
        $query = (new Query())
            ->from('order')
            ->where(['type' => Order::GIFT_MONEY_CODE])
            ->andWhere(['is_approved' => Order::ORDER_APPROVED])
            ->andWhere(['status' => Order::ORDER_NOT_PROCESSED])
            ->orderBy('id');

        foreach ($query->batch($count) as $orders) {
            if(count($orders) > 0) {
                foreach($orders as $order) {

                    $this->stdout('Order id: ' . $order['id'] . "\n", Console::BOLD);

                    $transaction = new Transaction();
                    $transaction->user_id = $order['user_id'];
                    $transaction->order_id = $order['id'];
                    $transaction->type = Order::GIFT_MONEY_CODE;
                    $transaction->name = Order::GIFT_MONEY_LABEL;

                    $orderObject = Order::findOne($order['id']);

                    if ($orderObject) {
                        $orderObject->status = Order::ORDER_PROCESSED;
                        $orderObject->save();
                        $transaction->save();
                    }
                }
            }
        }
        return ExitCode::OK;
    }
}

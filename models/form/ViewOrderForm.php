<?php

namespace app\models\form;

use app\strategy\GiftOrderFactory;
use yii\base\Model;
use app\models\Order;

class ViewOrderForm extends Model
{
    public $is_approved;
    public $convert_to_points;

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'is_approved' => 'Approve this gift',
            'convert_to_points' => 'Convert to points',
        ];
    }

    public function rules() {
        return [
            [['is_approved', 'convert_to_points'], 'safe'],
        ];
    }

    public function submit(Order $order) {

        if (!$this->validate()) {
            return null;
        }

        $giftOrder = GiftOrderFactory::getGiftOrder($order->type);
        $giftOrder->setOrder($order);

        if ($this->is_approved) {
            $giftOrder->setApproved();

            if ($this->convert_to_points) {
                $giftOrder->convertToPoints();
            }
            $giftOrder->createTransaction();
        }

        return $order->save() ? $order : null;
    }
}

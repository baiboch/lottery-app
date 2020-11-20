<?php

namespace app\models;

use app\factory\GiftOrderCreator;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * Order model
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $type
 * @property float $money
 * @property integer $points
 * @property string $gift
 * @property boolean $status
 * @property boolean $is_approved
 * @property boolean $convert_to_points
 * @property string $created_at
 * @property string $updated_at
 */
class Order extends ActiveRecord {

    const ORDER_APPROVED = 1;
    const ORDER_PROCESSED = 1;
    const ORDER_NOT_PROCESSED = 0;

    const CONVERT_TO_POINTS = 1;

    const GIFT_MONEY_CODE = 1;
    const GIFT_POINTS_CODE = 2;
    const GIFT_OBJECT_CODE = 3;

    const GIFT_MONEY_LABEL = 'money';
    const GIFT_POINTS_LABEL = 'points';
    const GIFT_OBJECT_LABEL = 'object';

    private $orderNameList = [
        self::GIFT_MONEY_CODE => self::GIFT_MONEY_LABEL,
        self::GIFT_POINTS_CODE => self::GIFT_POINTS_LABEL,
        self::GIFT_OBJECT_CODE => self::GIFT_OBJECT_LABEL,
    ];

    public static function tableName() {
        return '{{%order}}';
    }

    public function behaviors() {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function getId() {
        return $this->getPrimaryKey();
    }

    public function getType() {
        return $this->type;
    }

    public function getOrderName() {
        return $this->orderNameList[$this->getType()];
    }
}

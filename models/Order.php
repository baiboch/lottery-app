<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

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

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%order}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->getPrimaryKey();
    }
}
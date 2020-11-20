<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * Transaction model
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $order_id
 * @property integer $type
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 */
class Transaction extends ActiveRecord {

    public static function tableName() {
        return '{{%transaction}}';
    }

    public function behaviors() {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function getId() {
        return $this->getPrimaryKey();
    }
}
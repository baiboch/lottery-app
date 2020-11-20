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
 * @property integer $order_id
 * @property integer $type
 * @property string $created_at
 * @property string $updated_at
 */
class Transaction extends ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%transaction}}';
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
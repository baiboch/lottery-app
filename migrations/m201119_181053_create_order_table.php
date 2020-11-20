<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order}}`.
 */
class m201119_181053_create_order_table extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('order', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'type' => $this->tinyInteger()->notNull(),
            'money' => $this->integer()->notNull()->defaultValue(0),
            'points' => $this->integer()->null(),
            'gift' => $this->string()->null(),
            'status' => $this->tinyInteger(1)->defaultValue(0),
            'is_approved' => $this->tinyInteger(1)->defaultValue(0),
            'convert_to_points' => $this->tinyInteger(1)->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'idx-order-user_id',
            'order',
            'user_id'
        );

        $this->addForeignKey(
            'fk-order-user_id',
            'order',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('order');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%account_transaction}}`.
 */
class m201119_190045_create_transaction_table extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('transaction', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'order_id' => $this->integer()->notNull(),
            'type' => $this->tinyInteger()->notNull(),
            'name' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'idx-transaction-user_id',
            'transaction',
            'user_id'
        );

        $this->createIndex(
            'idx-transaction-order_id',
            'transaction',
            'order_id'
        );

        $this->addForeignKey(
            'fk-transaction-user_id',
            'transaction',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-transaction-order_id',
            'transaction',
            'order_id',
            'order',
            'id'
        );
    }

    public function down()
    {
        $this->dropTable('transaction');
    }
}

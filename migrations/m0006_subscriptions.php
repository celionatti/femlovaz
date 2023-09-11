<?php

use App\Core\Database\Migration;

/**
 * Subscriptions Migration. (Subscriptions Table)
 */
class m0006_subscriptions extends Migration
{
    public function up(): void
    {
        $SQL = "CREATE TABLE `subscriptions` (
        `id` bigint(20) NOT NULL AUTO_INCREMENT,
        `transaction_id` varchar(300) NOT NULL,
        `amount` bigint(20) DEFAULT NULL,
        `name` varchar(300) NOT NULL,
        `iuc_number` varchar(300) NOT NULL,
        `decoder_type` enum('dstv','gotv','free-to-air','') NOT NULL DEFAULT 'free-to-air',
        `payment_method` enum('cash','transfer','pos','web') NOT NULL DEFAULT 'cash',
        `note` varchar(300) NOT NULL,
        `status` enum('success','failed','pending') NOT NULL DEFAULT 'pending',
        `user_id` varchar(300) NULL DEFAULT 'femlovaz',
        `created_at` datetime NOT NULL DEFAULT current_timestamp(),
        `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
        PRIMARY KEY (`id`),
        KEY `transaction_id` (`transaction_id`),
        KEY `iuc_number` (`iuc_number`),
        KEY `decoder_type` (`decoder_type`),
        KEY `created_at` (`created_at`),
        KEY `name` (`name`),
        KEY `status` (`status`)
        ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4";
        $this->connection->exec($SQL);
    }

    public function down(): void
    {
        $SQL = "DROP TABLE subscriptions;";
        $this->connection->exec($SQL);
    }
}
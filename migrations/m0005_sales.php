<?php

use App\Core\Database\Migration;

/**
 * Sales Migration. (Sales Table)
 */
class m0005_sales extends Migration
{
    public function up(): void
    {
        $SQL = "CREATE TABLE `sales` (
        `id` bigint(20) NOT NULL AUTO_INCREMENT,
        `name` varchar(300) NOT NULL,
        `amount` bigint(20) DEFAULT NULL,
        `qty` bigint(20) DEFAULT NULL,
        `payment_method` enum('cash','transfer','pos','web') NOT NULL DEFAULT 'cash',
        `note` varchar(300) NOT NULL,
        `status` enum('success','failed','reversed','pending') NOT NULL DEFAULT 'pending',
        `user_id` varchar(300) NULL DEFAULT 'femlovaz',
        `created_at` datetime NOT NULL DEFAULT current_timestamp(),
        `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
        PRIMARY KEY (`id`),
        KEY `payment_method` (`payment_method`),
        KEY `name` (`name`),
        KEY `status` (`status`)
        ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4";
        $this->connection->exec($SQL);
    }

    public function down(): void
    {
        $SQL = "DROP TABLE sales;";
        $this->connection->exec($SQL);
    }
}
<?php

use App\Core\Database\Migration;

/**
 * Stocks Migration. (Stocks Table)
 */
class m0007_stocks extends Migration
{
    public function up(): void
    {
        $SQL = "CREATE TABLE `stocks` (
        `id` bigint(20) NOT NULL AUTO_INCREMENT,
        `slug` varchar(300) NOT NULL,
        `name` varchar(300) NOT NULL,
        `price` bigint(20) DEFAULT NULL,
        `qty` bigint(20) DEFAULT NULL,
        `status` enum('active','inactive','') NOT NULL DEFAULT 'active',
        `created_at` datetime NOT NULL DEFAULT current_timestamp(),
        `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
        PRIMARY KEY (`id`),
        KEY `slug` (`slug`),
        KEY `name` (`name`),
        KEY `created_at` (`created_at`),
        KEY `status` (`status`)
        ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4";
        $this->connection->exec($SQL);
    }

    public function down(): void
    {
        $SQL = "DROP TABLE stocks;";
        $this->connection->exec($SQL);
    }
}
<?php

use App\Core\Database\Migration;

/**
 * Customers Migration. (Customers Table)
 */
class m0004_customers extends Migration
{
    public function up(): void
    {
        $SQL = "CREATE TABLE `customers` (
        `id` bigint(20) NOT NULL AUTO_INCREMENT,
        `slug` varchar(300) NOT NULL,
        `name` varchar(300) NOT NULL,
        `othername` varchar(300) NULL,
        `email` varchar(300) NULL,
        `phone` bigint(20) DEFAULT NULL,
        `address` varchar(300) NOT NULL,
        `decoder_type` varchar(300) NOT NULL,
        `iuc_number` bigint(20) DEFAULT NULL,
        `blocked` tinyint(4) NOT NULL DEFAULT 0,
        `status` varchar(30) NOT NULL DEFAULT 'inactive',
        `created_at` datetime NOT NULL DEFAULT current_timestamp(),
        `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
        PRIMARY KEY (`id`),
        UNIQUE KEY `iuc_number` (`iuc_number`),
        KEY `name` (`name`),
        KEY `othername` (`othername`),
        KEY `decoder_type` (`decoder_type`)
        ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4";
        $this->connection->exec($SQL);
    }

    public function down(): void
    {
        $SQL = "DROP TABLE customers;";
        $this->connection->exec($SQL);
    }
}
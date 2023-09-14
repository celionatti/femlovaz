<?php

use App\Core\Database\Migration;

/**
 * Flows Migration. (Flows Table)
 */
class m0008_flows extends Migration
{
    public function up(): void
    {
        $SQL = "CREATE TABLE `flows` (
        `id` bigint(20) NOT NULL AUTO_INCREMENT,
        `flow_id` varchar(300) NOT NULL,
        `amount` bigint(20) DEFAULT NULL,
        `details` varchar(300) NOT NULL,
        `flow_type` enum('credit','debit','none') NOT NULL DEFAULT 'none',
        `status` enum('success','failed','pending') NOT NULL DEFAULT 'pending',
        `created_at` datetime NOT NULL DEFAULT current_timestamp(),
        `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
        PRIMARY KEY (`id`),
        UNIQUE KEY `flow_id` (`flow_id`),
        KEY `flow_type` (`flow_type`),
        KEY `created_at` (`created_at`),
        KEY `status` (`status`)
        ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4";
        $this->connection->exec($SQL);
    }

    public function down(): void
    {
        $SQL = "DROP TABLE flows;";
        $this->connection->exec($SQL);
    }
}
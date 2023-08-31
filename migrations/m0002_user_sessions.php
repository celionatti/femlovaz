<?php

use App\Core\Database\Migration;

/**
 * User Session Migration. (User Sessions Table)
 */
class m0002_user_sessions extends Migration
{
    public function up(): void
    {
        $SQL = "CREATE TABLE `user_sessions` (
        `id` bigint(20) NOT NULL AUTO_INCREMENT,
        `user_id` varchar(300) NOT NULL,
        `hash` varchar(300) DEFAULT NULL,
        `ip` varchar(300) NOT NULL,
        `os` varchar(300) NOT NULL,
        `device` varchar(300) NOT NULL,
        PRIMARY KEY (`id`),
        UNIQUE KEY `user_id` (`user_id`),
        KEY `ip` (`ip`),
        KEY `device` (`device`),
        KEY `hash` (`hash`)
        ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4";
        $this->connection->exec($SQL);
    }

    public function down(): void
    {
        $SQL = "DROP TABLE user_sessions;";
        $this->connection->exec($SQL);
    }
}
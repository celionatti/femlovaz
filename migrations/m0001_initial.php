<?php

use App\Core\Database\Migration;
use App\Core\Support\Helpers\Bcrypt;
use App\Core\Support\Helpers\Token;

/**
 * Initial Migration. (Users Table)
 */
class m0001_initial extends Migration
{
    public function up(): void
    {
        $SQL = "CREATE TABLE `users` (
        `id` bigint(20) NOT NULL AUTO_INCREMENT,
        `slug` varchar(300) NOT NULL,
        `surname` varchar(300) NOT NULL,
        `name` varchar(300) NOT NULL,
        `email` varchar(300) NOT NULL,
        `password` varchar(300) NOT NULL,
        `avatar` text DEFAULT NULL,
        `phone` bigint(20) DEFAULT NULL,
        `acl` enum('admin','guest','','') NOT NULL DEFAULT 'guest',
        `token` varchar(300) DEFAULT NULL,
        `blocked` tinyint(4) NOT NULL DEFAULT 0,
        `created_at` datetime NOT NULL DEFAULT current_timestamp(),
        `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
        PRIMARY KEY (`id`),
        UNIQUE KEY `email` (`email`),
        KEY `slug` (`slug`)
        ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4";
        $this->connection->exec($SQL);

        $password = Bcrypt::hashPassword("password");
        $slug = Token::generateOTP(6);

        $query = "INSERT INTO `users` (
            `id`, 
            `slug`, 
            `surname`, 
            `name`, 
            `email`, 
            `password`, 
            `acl`) VALUES 
            (NULL, '$slug', 'adminuser', 'admin', 'adminuser@admin.com','$password', 'admin')
            ";
        $this->connection->exec($query);
    }

    public function down(): void
    {
        $SQL = "DROP TABLE users;";
        $this->connection->exec($SQL);
    }
}
<?php

declare(strict_types=1);

namespace App\models;

use App\Core\Database\DbModel;


class Customers extends DbModel
{
    public static function tableName(): string
    {
        return 'customers';
    }
}
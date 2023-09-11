<?php

declare(strict_types=1);

namespace App\models;

use App\Core\Database\DbModel;
use App\Core\Support\Helpers\Token;
use App\Core\Validations\MinValidation;
use App\Core\Validations\UniqueValidation;
use App\Core\Validations\RequiredValidation;


class Stocks extends DbModel
{
    const STATUS_ACTIVE = "active";
    const STATUS_INACTIVE = "inactive";

    public string $slug = "";
    public string $name = "";
    public int|null|float $price = 0.0;
    public int|null $qty = null;
    public string $status = self::STATUS_ACTIVE;
    public string $created_at = "";
    public string $updated_at = "";

    public static function tableName(): string
    {
        return 'stocks';
    }

    public function beforeSave(): void
    {
        $this->timeStamps();

        $this->runValidation(new RequiredValidation($this, ['field' => 'name', 'msg' => "Name is a required field."]));

        $this->runValidation(new RequiredValidation($this, ['field' => 'price', 'msg' => "Price is a required field."]));

        $this->runValidation(new UniqueValidation($this, ['field' => ['name'], 'msg' => 'A Stock with that details already exists.']));

        $this->runValidation(new MinValidation($this, ['field' => 'qty', 'rule' => 1, 'msg' => "Qty must be at least 1 characters."]));

        if ($this->isNew()) {
            $this->slug = Token::generateOTP(6);
        }
    }
}

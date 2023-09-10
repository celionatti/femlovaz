<?php

declare(strict_types=1);

namespace App\models;

use App\Core\Database\DbModel;
use App\Core\Support\Helpers\Token;
use App\Core\Validations\MinValidation;
use App\Core\Validations\UniqueValidation;
use App\Core\Validations\RequiredValidation;


class Customers extends DbModel
{
    const BLOCKED = 0;
    const UNBLOCKED = 1;

    const STATUS_ACTIVE = "active";
    const STATUS_INACTIVE = "inactive";

    public string $slug = "";
    public string $name = "";
    public string|null $othername = null;
    public string|null $email = null;
    public string|null $phone = null;
    public string|null $address = "";
    public string|null $decoder_type = null;
    public int|null $iuc_number = null;
    public int $blocked = self::BLOCKED;
    public string $status = self::STATUS_ACTIVE;
    public string $created_at = "";
    public string $updated_at = "";

    public static function tableName(): string
    {
        return 'customers';
    }

    public function beforeSave(): void
    {
        $this->timeStamps();

        $this->runValidation(new RequiredValidation($this, ['field' => 'name', 'msg' => "Name is a required field."]));

        $this->runValidation(new RequiredValidation($this, ['field' => 'othername', 'msg' => "Othername is a required field."]));

        $this->runValidation(new UniqueValidation($this, ['field' => ['name', 'iuc_number', 'decoder_type'], 'msg' => 'A customer with that details already exists.']));

        $this->runValidation(new RequiredValidation($this, ['field' => 'address', 'msg' => "Adress is a required field."]));

        $this->runValidation(new RequiredValidation($this, ['field' => 'phone', 'msg' => "Phone Number is a required field."]));

        $this->runValidation(new RequiredValidation($this, ['field' => 'decoder_type', 'msg' => "Decoder Type is a required field."]));

        $this->runValidation(new RequiredValidation($this, ['field' => 'iuc_number', 'msg' => "IUC Number is a required field."]));

        $this->runValidation(new MinValidation($this, ['field' => 'iuc_number', 'rule' => 10, 'msg' => "IUC Number must be at least 10 characters."]));

        if ($this->isNew()) {
            $this->slug = Token::generateOTP(6);
        }
    }
}

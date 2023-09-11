<?php

declare(strict_types=1);

namespace App\models;

use App\Core\Database\DbModel;
use App\Core\Support\Helpers\Token;
use App\Core\Validations\MinValidation;
use App\Core\Validations\UniqueValidation;
use App\Core\Validations\RequiredValidation;


class Sales extends DbModel
{
    const STATUS_SUCCESS = "success";
    const STATUS_FAILED = "failed";
    const STATUS_REVERSED = "reversed";
    const STATUS_PENDING = "pending";

    const PAYMENT_CASH = "cash";
    const PAYMENT_TRANSFER= "transfer";
    const PAYMENT_WEB = "web";
    const PAYMENT_POS = "pos";

    public string $name = "";
    public int|null|float $amount = 0.0;
    public int|null $qty = 1;
    public string|null $payment_method = self::PAYMENT_CASH;
    public string|null $note = "";
    public string $status = self::STATUS_PENDING;
    public string $user_id = "femlovaz";
    public string $created_at = "";
    public string $updated_at = "";

    public static function tableName(): string
    {
        return 'sales';
    }

    public function beforeSave(): void
    {
        $this->timeStamps();

        $this->runValidation(new RequiredValidation($this, ['field' => 'name', 'msg' => "Name is a required field."]));

        $this->runValidation(new RequiredValidation($this, ['field' => 'amount', 'msg' => "Amount is a required field."]));

        $this->runValidation(new MinValidation($this, ['field' => 'qty', 'rule' => 1, 'msg' => "IUC Number must be at least 1 characters."]));

        if ($this->isNew()) {
            $this->user_id = $this->user_id;
        }
    }
}

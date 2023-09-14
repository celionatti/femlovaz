<?php

declare(strict_types=1);

namespace App\models;

use App\Core\Database\DbModel;
use App\Core\Support\Helpers\Token;
use App\Core\Validations\RequiredValidation;
use App\Core\Validations\UniqueValidation;

class Flows extends DbModel
{
    const STATUS_SUCCESS = "success";
    const STATUS_FAILED = "failed";
    const STATUS_PENDING = "pending";

    const FLOW_CREDIT = "credit";
    const FLOW_DEBIT = "debit";
    const FLOW_NONE = "none";

    public string $flow_id = "";
    public int|null|float $amount = 0.0;
    public string|null $details = "";
    public string $flow_type = self::FLOW_NONE;
    public string $status = self::STATUS_PENDING;
    public string $created_at = "";
    public string $updated_at = "";

    public static function tableName(): string
    {
        return 'flows';
    }

    public function beforeSave(): void
    {
        $this->timeStamps();

        $this->runValidation(new RequiredValidation($this, ['field' => 'flow_type', 'msg' => "Flow Type is a required field."]));

        $this->runValidation(new RequiredValidation($this, ['field' => 'amount', 'msg' => "Amount is a required field."]));

        $this->runValidation(new UniqueValidation($this, ['field' => ['flow_id'], 'msg' => 'A Flow with that Id already exists.']));

        if ($this->isNew()) {
            $this->flow_id = Token::TransactID(12);
        }
    }
}

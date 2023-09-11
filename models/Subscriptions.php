<?php

declare(strict_types=1);

namespace App\models;

use App\Core\Database\DbModel;
use App\Core\Support\Helpers\Token;
use App\Core\Validations\MinValidation;
use App\Core\Validations\UniqueValidation;
use App\Core\Validations\RequiredValidation;


class Subscriptions extends DbModel
{
    const STATUS_SUCCESS = "success";
    const STATUS_FAILED = "failed";
    const STATUS_PENDING = "pending";

    const PAYMENT_CASH = "cash";
    const PAYMENT_TRANSFER= "transfer";
    const PAYMENT_WEB = "web";
    const PAYMENT_POS = "pos";

    const DECODER_DSTV = "dstv";
    const DECODER_GOTV = "gotv";
    const DECODER_FREE_TO_AIR = "free-to-air";

    public string|null $transaction_id = null;
    public int|null|float $amount = 0.0;
    public string|null $name = null;
    public string|null $iuc_number = null;
    public string|null $decoder_type = self::DECODER_GOTV;
    public string|null $payment_method = self::PAYMENT_CASH;
    public string|null $note = "";
    public string $status = self::STATUS_PENDING;
    public string $user_id = "femlovaz";
    public string $created_at = "";
    public string $updated_at = "";

    public static function tableName(): string
    {
        return 'subscriptions';
    }

    public function beforeSave(): void
    {
        $this->timeStamps();

        $this->runValidation(new RequiredValidation($this, ['field' => 'transaction_id', 'msg' => "Transaction ID is a required field."]));

        $this->runValidation(new RequiredValidation($this, ['field' => 'amount', 'msg' => "Amount is a required field."]));

        $this->runValidation(new RequiredValidation($this, ['field' => 'name', 'msg' => "Name is a required field."]));

        $this->runValidation(new RequiredValidation($this, ['field' => 'decoder_type', 'msg' => "Decoder Type is a required field."]));

        $this->runValidation(new RequiredValidation($this, ['field' => 'iuc_number', 'msg' => "IUC Number is a required field."]));

        $this->runValidation(new MinValidation($this, ['field' => 'iuc_number', 'rule' => 10, 'msg' => "IUC Number must be at least 10 characters."]));

        if ($this->isNew()) {
            $this->transaction_id = Token::TransactID(6, "fem");
            $this->user_id = $this->user_id;
        }
    }
}

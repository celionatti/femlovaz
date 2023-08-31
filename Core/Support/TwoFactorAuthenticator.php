<?php

declare(strict_types=1);

namespace App\Core\Support;

use RobThree\Auth\TwoFactorAuth;


class TwoFactorAuthenticator {
    private $tfa;

    public function __construct() {
        $this->tfa = new TwoFactorAuth("MyApp");
    }

    public function generateSecretKey() {
        return $this->tfa->createSecret();
    }

    public function generateQRCodeData($label, $secret) {
        return $this->tfa->getQRCodeImageAsDataUri($label, $secret);
    }

    public function verifyCode($secret, $code) {
        return $this->tfa->verifyCode($secret, $code);
    }
}
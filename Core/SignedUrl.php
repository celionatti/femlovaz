<?php

declare(strict_types=1);

namespace App\Core;

use DateTime;

class SignedUrl
{
    private $baseURL;
    private $secretKey;

    public function __construct($baseURL, $secretKey) {
        $this->baseURL = $baseURL;
        $this->secretKey = $secretKey;
    }

    public function fromRoute($expirationTimestamp, $additionalParams = array()) {
        $additionalParams['expires'] = $expirationTimestamp;

        ksort($additionalParams);

        $queryString = http_build_query($additionalParams);
        $signature = $this->generateSignature($queryString);

        $signedURL = $this->baseURL . '?' . $queryString . '&signature=' . $signature;
        return $signedURL;
    }

    private function generateSignature($data) {
        $signature = hash_hmac('sha256', $data, $this->secretKey);
        return $signature;
    }
    // public function __construct(private readonly Config $config)
    // {
        
    // }


    // public function fromRoute(string $routeName, array $routeParams, DateTime $expirationDate)
    // {
    //     $expiration = $expirationDate->getTimeStamp();
    //     $routeParams = ['id' => $id, 'hash' => sha1($email)];
    //     $queryParams = ['expiration' => $expiration];
    //     $baseUrl = trim(ROOT, '/');
    //     $url = $baseUrl;

    //     $signature = hash_hmac('sha256', $url, $secret);

    //     return $baseUrl. $url;
    // }
}
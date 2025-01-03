<?php

namespace App\Http\Controllers;

abstract class Controller
{
    function encrypt($data, $key) {
        $keyLength = strlen($key);
        $encrypted = '';
        for ($i = 0; $i < strlen($data); $i++) {
            $encrypted .= chr(ord($data[$i]) ^ ord($key[$i % $keyLength]));
        }
        return $encrypted;
    }

    function decrypt($encryptedData, $key) {
        $keyLength = strlen($key);
        $decrypted = '';
        for ($i = 0; $i < strlen($encryptedData); $i++) {
            $decrypted .= chr(ord($encryptedData[$i]) ^ ord($key[$i % $keyLength]));
        }
        return $decrypted;
    }

    function getCardType($cardNumber)
    {
        $cardNumber = preg_replace('/\D/', '', $cardNumber);

        $cardTypes = [
            'Visa' => '/^4[0-9]{12}(?:[0-9]{3})?$/',
            'MasterCard' => '/^(?:5[1-5][0-9]{14}|2(?:2[2-9][0-9]{12}|[3-6][0-9]{13}|7[01][0-9]{12}|720[0-9]{12}))$/',
            'American Express' => '/^3[47][0-9]{13}$/',
            'Discover' => '/^6(?:011|5[0-9]{2}|4[4-9][0-9]|22(?:12[6-9]|[3-9][0-9]{2}|[2-9][0-9]))[0-9]{12}$/',
            'Diners Club' => '/^3(?:0[0-5]|[68][0-9])[0-9]{11}$/',
            'JCB' => '/^(?:2131|1800|35\d{3})\d{11}$/',
        ];

        foreach ($cardTypes as $type => $pattern) {
            if (preg_match($pattern, $cardNumber)) {
                return $type;
            }
        }

        return 'Unknown';
    }
}

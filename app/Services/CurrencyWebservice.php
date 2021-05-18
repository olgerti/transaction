<?php

namespace App\Services;

class CurrencyWebservice
{
    public function getRates(string $currency): array
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, 'https://api.exchangerate-api.com/v4/latest/'.$currency);

        $result = json_decode(curl_exec($ch), true);

        curl_close($ch);

        return $result['rates'];
    }
}

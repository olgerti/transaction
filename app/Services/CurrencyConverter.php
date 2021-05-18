<?php

namespace App\Services;

use App\Services\CurrencyWebservice;

class CurrencyConverter
{
    const EUR = 'EUR';
    const USD = 'USD';
    const GBP = 'GBP';

    const SYMBOL_TO_CURRENCY = [
        '€' => self::EUR,
        '$' => self::USD,
        '£' => self::GBP,
    ];

    const CURRENCY_TO_SYMBOL = [
        self::EUR => '€',
        self::USD => '$',
        self::GBP => '£',
    ];

    private $rates;

    public function __construct(string $currency, CurrencyWebservice $currencyWebservice)
    {
        $this->rates = $currencyWebservice->getRates($currency);
    }

    public function convert(string $amount)
    {
        ['currency' => $c, 'amount' => $a] = $this->parseAmount($amount);

        return $a / $this->rates[$c];
    }

    private function parseAmount(string $amount): array
    {
        return [
            'currency' => self::SYMBOL_TO_CURRENCY[mb_substr($amount, 0, 1)],
            'amount' => (float) mb_substr($amount, 1),
        ];
    }
}

<?php

namespace Tests\Unit;

use App\Services\CurrencyConverter;
use App\Services\CurrencyWebservice;
use Tests\TestCase;

class CurrencyConverterTest extends TestCase
{
    /** @test */
    public function it_converts_amount_to_given_currency()
    {
        $this->container->set(CurrencyWebservice::class, $this->getCurrencyWebserviceStub());

        $currencyConverter = $this->container->get(CurrencyConverter::class);

        $amount1 = $currencyConverter->convert('€50.12');
        $amount2 = $currencyConverter->convert('$100.50');
        $amount3 = $currencyConverter->convert('£50.40');

        $this->assertEquals($amount1, 50.12);
        $this->assertEquals($amount2, 100.50 / 1.5);
        $this->assertEquals($amount3, 50.40 / 0.5);
    }
}

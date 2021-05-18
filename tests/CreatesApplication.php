<?php

namespace Tests;

use DI\ContainerBuilder;
use App\Services\CurrencyConverter;
use App\Services\CurrencyWebservice;

trait CreatesApplication
{
    protected function createApplication()
    {
        $builder = new ContainerBuilder;
        $builder->addDefinitions(dirname(__DIR__).'/config/config.php');
        $container = $builder->build();

        return $container;
    }

    protected function getCurrencyWebserviceStub()
    {
        $stub = $this->createStub(CurrencyWebservice::class);

        $stub->method('getRates')->willReturn([
            CurrencyConverter::EUR => 1,
            CurrencyConverter::USD => 1.5,
            CurrencyConverter::GBP => 0.5
        ]);

        return $stub;
    }
}

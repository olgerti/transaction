<?php

use function DI\get;
use function DI\string;
use function DI\create;
use App\Services\FetchDataFromCsv;
use App\Services\CurrencyConverter;
use App\Services\CurrencyWebservice;

return [
    'root_dir' => dirname(__DIR__),
    'csv_path' => string('{root_dir}/data.csv'),
    'currency' => CurrencyConverter::EUR,

    FetchDataFromCsv::class => create()
        ->constructor(get('csv_path')),
    CurrencyConverter::class => create()
        ->constructor(get('currency'), get(CurrencyWebservice::class)),
];

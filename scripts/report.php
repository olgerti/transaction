<?php

require_once dirname(__DIR__).'/config/bootstrap.php';

use App\Models\Customer;
use App\Services\CurrencyConverter;

$args = getopt(null, ['customer_id:']);
$customer = $container->get(Customer::class);
$customer->setId($args['customer_id']);

printf("%s\t\t%s\t".PHP_EOL, 'Date', 'Amount');

foreach ($customer->getTransactions() as $transaction) {
    printf(
        "%s\t%s%s".PHP_EOL,
        $transaction['date'],
        $transaction['amount'],
        CurrencyConverter::CURRENCY_TO_SYMBOL[$container->get('currency')]
    );
}

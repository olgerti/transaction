<?php

namespace App\Models;

use App\Services\CurrencyConverter;
use App\Services\TransactionRepository;

class Customer
{
    private $id;
    private $transactionRepository;
    private $currencyConverter;

    public function __construct(TransactionRepository $transactionRepository, CurrencyConverter $currencyConverter)
    {
        $this->transactionRepository = $transactionRepository;
        $this->currencyConverter = $currencyConverter;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTransactions(): array
    {
        $transactions = $this->transactionRepository->getByCustomerId($this->id);

        return array_map(function ($row) {
            return [
                'id' => $row['id'],
                'date' => $row['date'],
                'amount' => number_format(
                    $this->currencyConverter->convert($row['amount']),
                    2
                )
            ];
        }, $transactions);
    }
}

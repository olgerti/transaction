<?php

namespace App\Services;

use App\Services\FetchDataFromCsv;

class TransactionRepository
{
    private $fetchDataFromCsv;

    public function __construct(FetchDataFromCsv $fetchDataFromCsv)
    {
        $this->fetchDataFromCsv = $fetchDataFromCsv;
    }

    public function getByCustomerId(int $customer_id): array
    {
        return array_filter($this->fetchDataFromCsv->data(), function ($row) use ($customer_id) {
            return $row['id'] == $customer_id;
        });
    }
}

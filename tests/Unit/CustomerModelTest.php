<?php

namespace Tests\Unit;

use App\Models\Customer;
use App\Services\CurrencyWebservice;
use Tests\TestCase;

class CustomerModelTest extends TestCase
{
    /** @test */
    public function it_returns_formatted_transactions_for_given_customer()
    {
        $this->container->set(CurrencyWebservice::class, $this->getCurrencyWebserviceStub());

        $temp = $this->setCsvDataIntoMemory('"customer";"date";"value"
1;"01/04/2015";"£50.00"');

        $this->container->set('csv_path', $temp);

        $customer = $this->container->get(Customer::class);
        $customer->setId(1);

        $transactions = $customer->getTransactions();

        $this->assertCount(1, $transactions);
        $this->assertEquals(1, $transactions[0]['id']);
        $this->assertEquals('01/04/2015', $transactions[0]['date']);
        $this->assertEquals(50.00 / 0.5, $transactions[0]['amount']);
    }

    private function setCsvDataIntoMemory(string $data)
    {
        $temp = tempnam(sys_get_temp_dir(), 'csv');

        file_put_contents($temp, $data);

        return $temp;
    }
}


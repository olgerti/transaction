<?php

namespace Tests\Unit;

use App\Services\TransactionRepository;
use Tests\TestCase;

class TransactionRepositoryTest extends TestCase
{
    /** @test */
    public function it_filters_results_by_customer_id()
    {
        $temp = $this->setCsvDataIntoMemory('"customer";"date";"value"
1;"01/04/2015";"£50.00"');

        $this->container->set('csv_path', $temp);

        $data = $this->container->get(TransactionRepository::class)->getByCustomerId(1);

        $this->assertCount(1, $data);
        $this->assertEquals(1, $data[0]['id']);
        $this->assertEquals('01/04/2015', $data[0]['date']);
        $this->assertEquals('£50.00', $data[0]['amount']);
    }

    /** @test */
    public function it_returns_empty_array_in_customers_with_no_transactions()
    {
        $temp = $this->setCsvDataIntoMemory('"customer";"date";"value"
1;"01/04/2015";"£50.00"');

        $this->container->set('csv_path', $temp);

        $data = $this->container->get(TransactionRepository::class)->getByCustomerId(2);

        $this->assertCount(0, $data);
    }

    private function setCsvDataIntoMemory(string $data)
    {
        $temp = tempnam(sys_get_temp_dir(), 'csv');

        file_put_contents($temp, $data);

        return $temp;
    }
}

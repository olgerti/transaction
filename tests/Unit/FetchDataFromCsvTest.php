<?php

namespace Tests\Unit;

use App\Services\FetchDataFromCsv;
use Tests\TestCase;

class FetchDataFromCsvTest extends TestCase
{
    /** @test */
    public function it_reads_data_given_valid_csv()
    {
        $temp = $this->setCsvDataIntoMemory('"customer";"date";"value"1;"01/04/2015";"£50.00"');

        $this->container->set('csv_path', $temp);

        $data = $this->container->get(FetchDataFromCsv::class)->data();

        $this->assertCount(1, $data);
        $this->assertEquals(1, $data[0]['id']);
        $this->assertEquals('01/04/2015', $data[0]['date']);
        $this->assertEquals('£50.00', $data[0]['amount']);
    }

    /** @test */
    public function it_returns_empty_array_given_invalid_csv()
    {
        $temp = $this->setCsvDataIntoMemory('invalid-csv');

        $this->container->set('csv_path', $temp);

        $data = $this->container->get(FetchDataFromCsv::class)->data();

        $this->assertCount(0, $data);
    }

    private function setCsvDataIntoMemory(string $data)
    {
        $temp = tempnam(sys_get_temp_dir(), 'csv');
        file_put_contents($temp, $data);

        return $temp;
    }
}

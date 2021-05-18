<?php

namespace App\Services;

class FetchDataFromCsv
{
    private $file_path;

    public function __construct(string $file_path)
    {
        $this->file_path = $file_path;
    }

    public function data()
    {
        $file = fopen($this->file_path, 'r');

        $headers = fgetcsv($file);

        $data = [];

        while (($row = fgetcsv($file, 0, ';')) !== false) {
            [$id, $date, $amount] = $row;

            $data[] = compact('id', 'date', 'amount');
        }

        fclose($file);

        return $data;
    }
}

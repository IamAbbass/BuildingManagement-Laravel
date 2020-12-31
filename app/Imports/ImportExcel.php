<?php

namespace App\Imports;

use App\Maintenance;
// use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;


class ImportExcel implements ToCollection
{
    public function collection(Collection $rows)
    {
        return $rows;
    }
}

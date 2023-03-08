<?php
namespace App\Import;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\FrequentlyMsg;

class MsgsampleImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new FrequentlyMsg([
            'column1' => $row['column1'],
            'column2' => $row['column2'],
            'column3' => $row['column3'],
        ]);
    }
}

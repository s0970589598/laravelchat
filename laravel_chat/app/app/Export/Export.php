<?php
namespace App\Import;

use App\Models\YourModel;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Export implements FromQuery, WithHeadings
{
    use Exportable;

    public function query()
    {
        return YourModel::query();
    }

    public function headings(): array
    {
        return [
            'Column 1',
            'Column 2',
            'Column 3',
        ];
    }
}
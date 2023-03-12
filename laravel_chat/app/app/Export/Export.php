<?php
namespace App\Export;

use App\Models\FAQ;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;

class FAQExport implements FromCollection
{
    use Exportable;

    public function collection()
    {
        return FAQ::all();
    }
}

public function exportCSV()
{
    return Excel::download(new FAQExport, 'faq.csv');
}

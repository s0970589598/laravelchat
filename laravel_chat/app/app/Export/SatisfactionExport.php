<?php
namespace App\Export;

use App\Models\Room;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\Exportable;

class SatisfactionExport implements FromArray
{
    use Exportable;

    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function array(): array
    {
        $rows = [];

        foreach ($this->data as $satisfaction) {
            $rows[] = [
                'service' => $satisfaction['service'],
                'callcustomer' => $satisfaction['callcustomer'],
                'complete' => $satisfaction['complete'],
                'waitedrate' => $satisfaction['waitedrate'],
                'replyrate' => gmdate("H:i:s", $satisfaction['replyrate']),
                'onlinerate' => $satisfaction['onlinerate'],
            ];
        }

        return $rows;
    }

    public function headings(): array
    {
        return [
            'service',
            'callcustomer',
            'complete',
            'waitedrate',
            'replyrate',
            'onlinerate',
        ];
    }
}

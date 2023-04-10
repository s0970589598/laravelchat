<?php

namespace App\Export;

use App\Models\SatisfactionSurvey;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Log;

class SatisfactionIndexExport implements FromCollection, WithHeadings
{
    protected $surveys;

    public function __construct($surveys)
    {
        $this->surveys = $surveys;
    }

    public function collection()
    {
        return $this->surveys;
        // return collect($this->surveys)->map(function ($survey) {
        //     return [
        //         'service' => $survey->station_name,
        //         'point' => $survey->point,
        //         'memo' => $survey->memo,
        //         'created_at' => $survey->created_at,
        //     ];
        // });
    }

    public function headings(): array
    {
        return [
            '服務',
            '滿意度',
            '備註',
            '中心',
            '日期',
        ];
    }
}

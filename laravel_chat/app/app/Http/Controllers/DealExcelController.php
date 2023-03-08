<?php
namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MsgsampleImport;
use App\Export\YourExport;

class DashboardController extends Controller
{
    public function import(Request $request)
    {
        $file = $request->file('file');
        $importFileType = $file->getClientOriginalExtension();

        if ($importFileType == 'csv') {
            $data = $this->importCSV($file);
        } elseif (in_array($importFileType, ['xlsx', 'xls'])) {
            $data = $this->importExcel($file);
        } else {
            return back()->with('error', 'Invalid file type');
        }

        Excel::import(new MsgsampleImport, $data);

    return redirect()->back()->with('success', '資料已匯入！');
        // // Save data to database
        // // ...

        // return back()->with('success', 'Data imported successfully');
    }

    private function importCSV($file)
    {
        $csv = Reader::createFromPath($file->getPathname());
        $csv->setHeaderOffset(0);
        $records = $csv->getRecords();
        $data = [];
        foreach ($records as $record) {
            $data[] = $record;
        }
        return $data;
    }

    private function importExcel($file)
    {
        return Excel::toArray(new UsersImport(), $file)[0];
    }

    public function exportCsv(Request $request)
    {
        $filename = 'your-export.csv';

        return Excel::download(new YourExport, $filename);
    }
}
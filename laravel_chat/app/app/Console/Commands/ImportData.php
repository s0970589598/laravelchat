<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use App\Repositories\MotcStationRepository;

class ImportData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:importfaq';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(MotcStationRepository $motc_station_repository)
    {
       // $data = Excel::load('/file/faq.xlsx')->get();
        $data = Excel::toArray([], './public/file/faq.xlsx')[0];
        foreach ($data as $row) {
            // 將每一列資料匯入資料庫中
            if ($row[0] != '站別'){
                if (! is_null($row[0])) {
                    echo $row[0];
                    list($domain_alias,$motc_station) = explode(' ',$row[0]);
                    echo $domain_alias;

                } else {
                    $domain_alias = $domain_alias;
                }

                $motc = $motc_station_repository->motcStationList(['domain_alias'=>$domain_alias]);
                $sn = isset($motc[0]) ? $motc[0]->sn : '';
                DB::table('faq')->insert([
                    'service'  => $sn,
                    'question' => isset($row[1]) ? $row[1] : '',
                    'answer' => isset($row[2]) ? $row[2] : '',
                ]);
            }
        }
        return 0;
    }
}

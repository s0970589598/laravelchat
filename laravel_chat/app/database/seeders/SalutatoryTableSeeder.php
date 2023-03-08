<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalutatorytableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = <<<EOL
        INSERT INTO salutatory (id,subject, content, status) VALUES ('1','歡迎詞 1', '歡迎您使用交通部觀光局數位客服！ 請您點選下方「協助定位」按鈕進行定位，讓我們可以提供更準確的資訊給您！ 若您有緊急事件要詢問，可撥打下方24小時服務電話： 0800-011765', '0');
        INSERT INTO salutatory (id,subject, content, status) VALUES ('2','歡迎詞 2', '使用數位客服後，誠摯邀請您點選下方常駐選單，並點選滿意度調查，為我們的服務進行評分並留下您寶貴的意見，讓我們可以持續提供優良的服務，謝謝您！', '0');
        EOL;
        DB::unprepared($sql);
    }
}

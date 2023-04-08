<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\FAQ;
use App\Models\FrequentlyMsg;
use Illuminate\Support\Str;

class CheckUrlStatus extends Command
{
    // protected $name = 'command:checkonlineusers';

    protected $signature = 'check-url-status';

    protected $description = 'Check url status';

    public function handle(UserRepository $user_repository)
    {
        // Log::info('check-url-status');

        $faq = FAQ::orderBy('id', 'desc')
        ->where('status','0')
        ->get();

        $msg_sample = FrequentlyMsg::orderBy('id', 'desc')
        ->where('status','0')
        ->get();

        foreach ($faq as $f) {
            $string = $f['answer'];
            $pattern = '/\b((?:https?|ftp):\/\/[^\s<>\[\]{}|\\^`]+(?:\.[^\s<>\[\]{}|\\^`]+)*\/?\S*)\b/';
            preg_match($pattern, $string, $matches);
            // 判斷是否找到網址
            if (isset($matches[0])) {
                // 如果有找到網址，就取出來
                $url = $matches[0];
                // echo '找到網址：' . $url;
                // Log::info('faq');
                // Log::info($url);
                $is_success = $this->curlUrl($url);
                if (! $is_success ) {
                    FAQ::find($f['id'])
                    ->update([
                        'is_err' => 1
                    ]);
                } else {
                    FAQ::find($f['id'])
                    ->update([
                        'is_err' => 0
                    ]);
                }
                //} else {
                // 如果沒有找到網址，就顯示訊息
                // echo '找不到網址。';
            }
        }
        foreach ($msg_sample as $m) {
            $string = $m['reply'];
            $pattern = '/\b((?:https?|ftp):\/\/[^\s<>\[\]{}|\\^`]+(?:\.[^\s<>\[\]{}|\\^`]+)*\/?\S*)\b/';
            preg_match($pattern, $string, $matches);
            // 判斷是否找到網址
            if (isset($matches[0])) {
                // 如果有找到網址，就取出來
                $url = $matches[0];
                // echo '找到網址：' . $url;
                // Log::info('msgsample');
                // Log::info($url);
                $is_success = $this->curlUrl($url);
                if (! $is_success ) {
                    FrequentlyMsg::find($m['id'])
                    ->update([
                        'is_err' => 1
                    ]);
                } else {
                    FrequentlyMsg::find($m['id'])
                    ->update([
                        'is_err' => 0
                    ]);
                }
                //} else {
                // 如果沒有找到網址，就顯示訊息
                // echo '找不到網址。';
            }
        }
    }

    private function curlUrl($url){
        // 初始化一個 cURL 對象
        $ch = curl_init($url);
        // 設定 cURL 選項
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // 執行 cURL 請求
        $response = curl_exec($ch);
        // 檢查請求是否成功
        if ($response === false) {
            // 如果請求失敗，顯示錯誤訊息
            $error = curl_error($ch);
            // echo 'cURL 錯誤：' . $error;
            $is_success = false;
        } else {
            // 如果請求成功，顯示回應訊息
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            // echo 'HTTP 狀態碼：' . $httpCode;
            $is_success = true;

        }
        // 關閉 cURL 對象
        curl_close($ch);
        return $is_success;
    }
}

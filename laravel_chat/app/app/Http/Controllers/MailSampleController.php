<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Room;
use App\Models\Media;
use App\Models\EmailSample;
use denis660\Centrifugo\Centrifugo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class MailSampleController extends Controller
{
    //private Centrifugo $centrifugo;
    protected $centrifugo;
    public function __construct(Centrifugo $centrifugo)
    {
        $this->centrifugo = $centrifugo;
    }

    public function index(Request $request)
    {
        $rooms = 0;
        $limit = 10;
        if (isset($request['limit']) && $request['limit']) {
            $limit = $request['limit'] ;
        }
        $email_sample = EmailSample::orderBy('id', 'desc')
        ->where('status','0')
        ->paginate($limit);

        return view('mailsample.index', [
            'rooms' => $rooms,
            'email_sample' => $email_sample,
        ]);
    }


    public function store(Request $request)
    {
        $params = $request->validate([
            'type'   => ['required'],
            'subject'   => ['required'],
            'content'   => ['required'],
        ]);

        DB::beginTransaction();
        try {
            $mailsample = EmailSample::create([
                'type'        => $params['type'],
                'subject'     => $params['subject'],
                'content'     => $params['content'],
                'status'      => 0,
            ]);
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }

        return redirect()->route('mailsample.index', $mailsample->id);
    }

    public function update(Request $request)
    {
        EmailSample::find($request['id'])
            ->update([
                'type'        => $request['type'],
                'subject'     => $request['subject'],
                'content'     => $request['content'],
        ]);
        return redirect()->route('mailsample.index');

    }

    public function upstatus(Request $request)
    {
        $mail = EmailSample::find($request['id'])
            ->update([
                'status'        => 1,
        ]);
        return redirect()->route('mailsample.index');
    }

}

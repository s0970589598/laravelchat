<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use App\Models\Message;
use App\Models\Room;
use denis660\Centrifugo\Centrifugo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class FaqController extends Controller
{
    //private Centrifugo $centrifugo;
    protected $centrifugo;
    public function __construct(Centrifugo $centrifugo)
    {
        $this->centrifugo = $centrifugo;
    }

    public function index()
    {
        $rooms = 0;
        $limit = 10;
        if (isset($request['limit']) && $request['limit']) {
            $limit = $request['limit'] ;
        }
        $faq = FAQ::orderBy('id', 'desc')
        ->where('status','0')
        ->paginate($limit);

        return view('faq.index', [
            'rooms' => $rooms,
            'faq'=> $faq,
        ]);
    }

    public function show(int $id)
    {
        $faq = FAQ::find($id);

        return view('faq.index', [
            'faqByid'    => $faq,
        ]);
    }

    public function update(request $request)
    {
        $faq = FAQ::find($request['id'])
            ->update([
                'question'     => $request['question'],
                'answer'       => $request['answer'],
                'url'          => $request['url'],
        ]);
        return redirect()->route('faq.index');

    }

    public function upstatus(request $request)
    {
        $faq = FAQ::find($request['id'])
            ->update([
                'status'     => 1,
        ]);
        return redirect()->route('faq.index');

    }

    public function store(Request $request)
    {
        $params = $request->validate([
            'question'   => ['required'],
            'answer'   => ['required'],
            //'url'   => ['required'],
        ]);
        DB::beginTransaction();
        try {
            $faq = FAQ::create([
                'question'     => $params['question'],
                'answer'       => $params['answer'],
                //'url'          => $params['url'],
                'status'       => 0,
            ]);
            // $room->users()->attach(Auth::user()->id);
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }

        return redirect()->route('faq.index');
    }

}

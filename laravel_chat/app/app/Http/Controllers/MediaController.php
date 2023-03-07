<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Room;
use App\Models\Media;
use denis660\Centrifugo\Centrifugo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class MediaController extends Controller
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
        $limit = 2;
        if (isset($request['limit']) && $request['limit']) {
            $limit = $request['limit'] ;
        }
        $media = Media::orderBy('id', 'desc')
        ->where('status','0')
        ->paginate($limit);

        return view('media.index', [
            'rooms' => $rooms,
            'media' => $media,
        ]);
    }

    public function store(Request $request)
    {
        $params = $request->validate([
            'type'   => ['required'],
            'title'  => ['required'],
            'file'   => ['required'],
        ]);

        $fileName = time() . '.'. $request->file->extension();

        $type = $request->file->getClientMimeType();
        $size = $request->file->getSize();

        $request->file->move(public_path('file'), $fileName);

        DB::beginTransaction();
        try {
            $media = Media::create([
                'type'        => $params['type'],
                'title'       => $params['title'],
                'file'        => $fileName,
                'status'      => 0,
            ]);
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }

        return redirect()->route('media.index', $media->id);
    }

    public function update(Request $request)
    {
        $params = array(
            'type' =>$request['type'],
            'title' =>$request['title'],
        );
        if ($request->file) {
            $fileName = time() . '.'. $request->file->extension();
            $type = $request->file->getClientMimeType();
            $size = $request->file->getSize();
            $request->file->move(public_path('file'), $fileName);
            $params['file'] = $fileName;
        }

        Media::find($request['id'])
            ->update($params);
        return redirect()->route('media.index');

    }

    public function upstatus(Request $request)
    {
        Media::find($request['id'])
            ->update([
                'status'        => 1,
        ]);
        return redirect()->route('media.index');

    }

}

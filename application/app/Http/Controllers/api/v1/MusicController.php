<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Music;

class MusicController extends Controller
{
    public function create(Request $r)
    {
        try {
            $music = new Music();
            $music->name = $r->name;
            $music->scale_id = $r->scale_id;
            $music->artist = $r->artist;
            $music->link = $r->link;
            $music->tom = $r->tom;


            if ($music->save()) {
                return response()->json(['status' => 'success', 'data' => $music]);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
        }
    }
}

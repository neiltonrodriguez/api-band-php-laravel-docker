<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Scale;
use Illuminate\Support\Facades\DB;

class ScaleController extends Controller
{
    public function create(Request $r)
    {
        try {
            $scale = new Scale();
            $scale->title = $r->title;
            $scale->group_id = $r->group_id;
            $scale->start = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $r->start)));
            $scale->end = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $r->end)));


            if ($scale->save()) {
                return response()->json(['status' => 'success', 'data' => $scale]);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
        }
    }
    public function getAll($groupid, $memberid)
    {
        $scales = DB::table('scale')
            ->join('member_scale', 'scale.id', '=', 'member_scale.scale_id')
            ->where('scale.group_id', '=', $groupid)
            ->where('member_scale.member_id', '=', $memberid)
            ->select('scale.*')
            ->get();

        return response()->json(['status' => 'success', 'data' => $scales]);
    }
    public function getById($id)
    {
        // dd($id);

        $scale = DB::table('scale')
            ->where('scale.id', '=', $id)
            ->select('scale.*')
            ->get();

        $members = DB::table('member')
            ->join('member_scale', 'member.id', '=', 'member_scale.member_id')
            ->where('member_scale.scale_id', '=', $id)
            ->select('member.first_name', 'member.last_name', 'member.email', 'member.instrument', 'member.profile_id')
            ->get();

        $music = DB::table('music')
            ->where('music.scale_id', '=', $id)
            ->select('music.*')
            ->get();
            
        $return = [
            'scale' => $scale,
            'member' => $members,
            'music' => $music
        ];

        return response()->json(['status' => 'success', 'data' => $return ]);
    }
}

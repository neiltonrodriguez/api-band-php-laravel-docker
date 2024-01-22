<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    public function create(Request $r)
    {
        try {
            $group = new Group();
            $group->name = $r->name;
            $group->description = $r->description;
            $numero_de_bytes = 4;

            $restultado_bytes = random_bytes($numero_de_bytes);
            $resultado_final = bin2hex($restultado_bytes);
            $group->code = strtoupper($resultado_final);

            if ($group->save()) {
                return response()->json(['status' => 'success', 'data' => $group]);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
        }
    }
    public function getAll($id)
    {
        $u = auth()->user();
        if ($u->profile_id == 1) {
        $groups = DB::table('group')
                    ->join('member_group', 'group.id', '=', 'member_group.group_id')
                    ->join('member', 'member_group.member_id', '=', 'member.id')
                    ->select('group.*')
                    ->get();
        
        return response()->json(['status' => 'success', 'data' => $groups]);
        } else {
        $groups = DB::table('group')
            ->join('member_group', 'group.id', '=', 'member_group.group_id')
            ->join('member', 'member_group.member_id', '=', 'member.id')
            ->where('member_group.member_id', '=', $id)
            ->select('group.*')
            ->get();

        return response()->json(['status' => 'success', 'data' => $groups]);
        }
    }
}

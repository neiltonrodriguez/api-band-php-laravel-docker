<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\GroupUser;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    public function create(Request $r)
    {
        $u = auth()->user();
        try {
            $group = new Group();
            $group->name = $r->name;
            $group->description = $r->description;
            $numero_de_bytes = 4;

            $restultado_bytes = random_bytes($numero_de_bytes);
            $resultado_final = bin2hex($restultado_bytes);
            $group->code = strtoupper($resultado_final);

            if ($group->save()) {
                $groupmember = new GroupUser();
                $groupmember->user_id = $u->id;
                $groupmember->group_id = $group->id;
                $groupmember->created_at = now();
                $groupmember->updated_at = now();
                if ($groupmember->save()) {
                    return response()->json(['status' => 'success', 'data' => $group]);
                }
            }
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
        }
    }
    public function getAll()
    {
        $u = auth()->user();
        if ($u->profile_id == 1) {
            $groups = DB::table('group')
                ->join('user_group', 'group.id', '=', 'user_group.group_id')
                ->join('users', 'user_group.user_id', '=', 'users.id')
                ->select('group.*')
                ->get();

            return response()->json(['status' => 'success', 'data' => $groups]);
        } else {
            $groups = DB::table('group')
                ->join('user_group', 'group.id', '=', 'user_group.group_id')
                ->join('users', 'user_group.user_id', '=', 'users.id')
                ->where('user_group.user_id', '=', $u->id)
                ->select('group.*')
                ->get();

            return response()->json(['status' => 'success', 'data' => $groups]);
        }
    }
}

<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GroupMember;
use App\Models\Group;

class GroupMemberController extends Controller
{
    public function create(Request $r)
    {
        try {
            $groupmember = new GroupMember();
            $groupmember->member_id = $r->member_id;
            $group = Group::where('code', '=', $r->code)->first();
            $groupmember->group_id = $group->id;
            if ($groupmember->save()) {
                return response()->json(['status' => 'success', 'data' => $group]);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
        }
    }
}

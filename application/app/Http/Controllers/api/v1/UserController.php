<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function create(Request $r)
    {
        // $u = auth()->user();
        // if ($u->profile_id != 1) {
            try {
                $user = new User();
                $user->first_name = $r->first_name;
                $user->last_name = $r->last_name;
                $user->email = $r->email;
                $user->instrument = $r->instrument;
                $user->password = bcrypt($r->password);
                $profile_id = 1;
                if (isset($r->profile_id)) {
                    $profile_id = $r->profile_id;
                }
                $user->profile_id = $profile_id;
                $is_active = false;
                if ($r->is_active) {
                    $is_active = true;
                }
                $user->is_active = $is_active;

                if ($user->save()) {
                    return response()->json(['status' => 'success', 'data' => $user]);
                }
            } catch (\Exception $e) {
                return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
            }
        // }
        return response()->json(['error' => true, 'message' => 'voce nao tme permissao para executar essa acao'], 500);
    }
}